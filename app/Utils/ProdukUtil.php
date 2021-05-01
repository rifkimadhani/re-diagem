<?php

namespace App\Utils;

use App\Models\Toko_id;

use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\VariasiDetail;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\TransactionSellLinesPurchaseLines;
use App\Unit;
use Illuminate\Support\Facades\DB;

class ProdukUtil extends Util
{


    /**
     * Cek apakah fitur kelola stok di aktif, jika diaktifkan meperbaharui kuantitas variasi produk
     *
     * @param $bisnis_id
     * @param $outlet_id
     * @param $produk_id
     * @param $variasi_id
     * @param $qty_baru
     * @param $qty_lama = 0
     * @param $number_format = null
     * @param $uf_data = true, if false it will accept numbers in database format
     *
     * @return boolean
     */
    public function updateProdukQty($bisnis_id, $outlet_id, $produk_id, $variasi_id, $qty_baru, $qty_lama = 0)
    {
        $qty_diff = $qty_baru - $qty_lama;

        // $produk = Produk::find($produk_id);
        $produkvariasi = ProdukVariasi::find($variasi_id);
        //Cek Apakah Produk Variasi Mengelola Stok
        if ($produkvariasi->kelola_stok == 1 && $qty_diff != 0) {

            //Tambah kuantitas di Variasi Produk Detail
            $variasi_detail = VariasiDetail::where('variasi_id', $variasi_id)
                                    ->where('produk_id', $produk_id)
                                    ->where('outlet_id', $outlet_id)
                                    ->first();
            if (empty($variasi_detail)) {
                $variasi_detail = new VariasiDetail();
                $variasi_detail->variasi_id = $produkvariasi->id;
                $variasi_detail->produk_id = $produk_id;
                $variasi_detail->outlet_id = $outlet_id;
                $variasi_detail->qty_tersedia = 0;
            }

            $variasi_detail->qty_tersedia += $qty_diff;
            $variasi_detail->save();
        }

        return true;
    }

    /**
     * Cek jika kelola stok di produk di aktifkan maka stok produk akan di kurangi.
     *
     * @param $produk_id
     * @param $variasi_id
     * @param $outlet_id
     * @param $new_quantity
     * @param $old_quantity = 0
     *
     * @return boolean
     */
    public function decreaseProdukQty($produk_id, $variasi_id, $outlet_id, $qty_baru, $qty_lama = 0)
    {
        $qty = $qty_baru - $qty_lama;

        $produk = ProdukVariasi::find($variasi_id);
        if ($produk->kelola_stok == 1) {
            //Kurangi kuantitas produk pada tabel Variasi Detail
            $coba = VariasiDetail::where('variasi_id', $variasi_id)
                ->where('produk_id', $produk_id)
                ->where('outlet_id', $outlet_id)
                ->decrement('qty_tersedia', $qty);
            if($coba)
            {
                return true;
            }else{
                return false;
            }
        }

        // return true;
    }

    /**
     * Get all details for a product from its variation id
     *
     * @param int $variation_id
     * @param int $business_id
     * @param int $location_id
     * @param bool $check_qty (If false qty_available is not checked)
     *
     * @return array
     */
    public function getDetailsFromVariation($variation_id, $business_id, $location_id = null, $check_qty = true)
    {
        $query = Variation::join('products AS p', 'variations.product_id', '=', 'p.id')
                ->join('product_variations AS pv', 'variations.product_variation_id', '=', 'pv.id')
                ->leftjoin('variation_location_details AS vld', 'variations.id', '=', 'vld.variation_id')
                ->leftjoin('units', 'p.unit_id', '=', 'units.id')
                ->leftjoin('brands', function ($join) {
                    $join->on('p.brand_id', '=', 'brands.id')
                        ->whereNull('brands.deleted_at');
                })
                ->where('p.business_id', $business_id)
                ->where('variations.id', $variation_id);

        //Add condition for check of quantity. (if stock is not enabled or qty_available > 0)
        if ($check_qty) {
            $query->where(function ($query) use ($location_id) {
                $query->where('p.enable_stock', '!=', 1)
                    ->orWhere('vld.qty_available', '>', 0);
            });
        }

        if (!empty($location_id)) {
            //Check for enable stock, if enabled check for location id.
            $query->where(function ($query) use ($location_id) {
                $query->where('p.enable_stock', '!=', 1)
                            ->orWhere('vld.location_id', $location_id);
            });
        }

        $products = $query->select(
            DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name,
                    ' (', pv.name, ':',variations.name, ')'), p.name) AS product_name"),
            'p.id as product_id',
            'p.brand_id',
            'p.category_id',
            'p.tax as tax_id',
            'p.enable_stock',
            'p.enable_sr_no',
            'p.name as product_actual_name',
            'pv.name as product_variation_name',
            'pv.is_dummy as is_dummy',
            'variations.name as variation_name',
            'variations.sub_sku',
            'p.barcode_type',
            'vld.qty_available',
            'variations.default_sell_price',
            'variations.sell_price_inc_tax',
            'variations.id as variation_id',
            'units.short_name as unit',
            'units.id as unit_id',
            'units.allow_decimal as unit_allow_decimal',
            'brands.name as brand',
            DB::raw("(SELECT purchase_price_inc_tax FROM purchase_lines WHERE
                        variation_id=variations.id ORDER BY id DESC LIMIT 1) as last_purchased_price")
        )
                ->first();

        return $products;
    }

    /**
     * Calculates the total amount of invoice
     *
     * @param array $products
     * @param int $tax_id
     * @param array $discount['discount_type', 'discount_amount']
     *
     * @return Mixed (false, array)
     */
    public function calculateInvoiceTotal($products, $tax_id, $discount = null)
    {
        if (empty($products)) {
            return false;
        }

        $output = ['total_before_tax' => 0, 'tax' => 0, 'discount' => 0, 'final_total' => 0];

        //Sub Total
        foreach ($products as $product) {
            $output['total_before_tax'] += $this->num_uf($product['unit_price_inc_tax']) * $this->num_uf($product['quantity']);

            //Add modifier price to total if exists
            if (!empty($product['modifier_price'])) {
                foreach ($product['modifier_price'] as $modifier_price) {
                    $output['total_before_tax'] += $this->num_uf($modifier_price);
                }
            }
        }

        //Calculate discount
        if (is_array($discount)) {
            if ($discount['discount_type'] == 'fixed') {
                $output['discount'] = $this->num_uf($discount['discount_amount']);
            } else {
                $output['discount'] = ($this->num_uf($discount['discount_amount'])/100)*$output['total_before_tax'];
            }
        }

        //Tax
        $output['tax'] = 0;
        if (!empty($tax_id)) {
            $tax_details = TaxRate::find($tax_id);
            if (!empty($tax_details)) {
                $output['tax_id'] = $tax_id;
                $output['tax'] = ($tax_details->amount/100) * ($output['total_before_tax'] - $output['discount']);
            }
        }

        //Calculate total
        $output['final_total'] = $output['total_before_tax'] + $output['tax'] - $output['discount'];

        return $output;
    }

    /**
     * Generates product sku
     *
     * @param string $string
     *
     * @return generated sku (string)
     */
    public function generateProductSku($string)
    {
        $business_id = request()->session()->get('user.business_id');
        $sku_prefix = Business::where('id', $business_id)->value('sku_prefix');

        return $sku_prefix . str_pad($string, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Gives list of trending products
     *
     * @param int $business_id
     * @param array $filters
     *
     * @return Obj
     */
    public function getTrendingProducts($business_id, $filters = [])
    {
        $query = Transaction::join(
            'transaction_sell_lines as tsl',
            'transactions.id',
            '=',
            'tsl.transaction_id'
        )
                    ->join('products as p', 'tsl.product_id', '=', 'p.id')
                    ->leftjoin('units as u', 'u.id', '=', 'p.unit_id')
                    ->where('transactions.business_id', $business_id)
                    ->where('transactions.type', 'sell')
                    ->where('transactions.status', 'final');

        $permitted_locations = auth()->user()->permitted_locations();
        if ($permitted_locations != 'all') {
            $query->whereIn('transactions.location_id', $permitted_locations);
        }
        if (!empty($filters['location_id'])) {
            $query->where('transactions.location_id', $filters['location_id']);
        }
        if (!empty($filters['category'])) {
            $query->where('p.category_id', $filters['category']);
        }
        if (!empty($filters['sub_category'])) {
            $query->where('p.sub_category_id', $filters['sub_category']);
        }
        if (!empty($filters['brand'])) {
            $query->where('p.brand_id', $filters['brand']);
        }
        if (!empty($filters['unit'])) {
            $query->where('p.unit_id', $filters['unit']);
        }
        if (!empty($filters['limit'])) {
            $query->limit($filters['limit']);
        } else {
            $query->limit(5);
        }
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween(DB::raw('date(transaction_date)'), [$filters['start_date'],
                $filters['end_date']]);
        }

        // $sell_return_query = "(SELECT SUM(TPL.quantity) FROM transactions AS T JOIN purchase_lines AS TPL ON T.id=TPL.transaction_id WHERE TPL.product_id=tsl.product_id AND T.type='sell_return'";
        // if ($permitted_locations != 'all') {
        //     $sell_return_query .= ' AND T.location_id IN ('
        //      . implode(',', $permitted_locations) . ') ';
        // }
        // if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
        //     $sell_return_query .= ' AND date(T.transaction_date) BETWEEN \'' . $filters['start_date'] . '\' AND \'' . $filters['end_date'] . '\'';
        // }
        // $sell_return_query .= ')';

        $products = $query->select(
            DB::raw("(SUM(tsl.quantity) - COALESCE(SUM(tsl.quantity_returned), 0)) as total_unit_sold"),
            'p.name as product',
            'u.short_name as unit'
        )
                        ->groupBy('tsl.product_id')
                        ->orderBy('total_unit_sold', 'desc')
                        ->get();
        return $products;
    }

    /**
     * Gives list of products based on products id and variation id
     *
     * @param int $business_id
     * @param int $product_id
     * @param int $variation_id = null
     *
     * @return Obj
     */
    public function getDetailsFromProduct($business_id, $product_id, $variation_id = null)
    {
        $product = Product::leftjoin('variations as v', 'products.id', '=', 'v.product_id')
                        ->whereNull('v.deleted_at')
                        ->where('products.business_id', $business_id);

        if (!is_null($variation_id) && $variation_id !== '0') {
            $product->where('v.id', $variation_id);
        }

        $product->where('products.id', $product_id);

        $products = $product->select(
            'products.id as product_id',
            'products.name as product_name',
            'v.id as variation_id',
            'v.name as variation_name'
        )
                    ->get();

        return $products;
    }

    /**
     * F => D (Previous product Increase)
     * D => F (All product decrease)
     * F => F (Newly added product drerease)
     *
     * @param  object $transaction_before
     * @param  object  $transaction
     * @param  array  $input
     *
     * @return void
     */
    public function adjustProductStockForInvoice($status_before, $transaction, $input, $uf_data = true)
    {
        if ($status_before == 'final' && $transaction->status == 'draft') {
            foreach ($input['products'] as $product) {
                if (!empty($product['transaction_sell_lines_id'])) {
                    $this->updateProductQuantity($input['location_id'], $product['product_id'], $product['variation_id'], $product['quantity'], 0, null, false);
                }
            }
        } elseif ($status_before == 'draft' && $transaction->status == 'final') {
            foreach ($input['products'] as $product) {
                $uf_quantity = $uf_data ? $this->num_uf($product['quantity']) : $product['quantity'];
                $this->decreaseProductQuantity(
                    $product['product_id'],
                    $product['variation_id'],
                    $input['location_id'],
                    $uf_quantity
                );
            }
        } elseif ($status_before == 'final' && $transaction->status == 'final') {
            foreach ($input['products'] as $product) {
                if (empty($product['transaction_sell_lines_id'])) {
                    $uf_quantity = $uf_data ? $this->num_uf($product['quantity']) : $product['quantity'];
                    $this->decreaseProductQuantity(
                        $product['product_id'],
                        $product['variation_id'],
                        $input['location_id'],
                        $uf_quantity
                    );
                }
            }
        }
    }

    /**
     * Updates variation from purchase screen
     *
     * @param array $variation_data
     *
     * @return void
     */
    public function updateProductFromPurchase($variation_data)
    {
        $variation_details = Variation::where('id', $variation_data['variation_id'])
                                        ->with(['product', 'product.product_tax'])
                                        ->first();
        $tax_rate = 0;
        if (!empty($variation_details->product->product_tax->amount)) {
            $tax_rate = $variation_details->product->product_tax->amount;
        }

        if (($variation_details->default_purchase_price != $variation_data['pp_without_discount']) ||
            ($variation_details->default_sell_price != $variation_data['default_sell_price'])
            ) {
            //Set default purchase price exc. tax
            $variation_details->default_purchase_price = $variation_data['pp_without_discount'];

            //Set default purchase price inc. tax
            $variation_details->dpp_inc_tax = $this->calc_percentage($variation_details->default_purchase_price, $tax_rate, $variation_details->default_purchase_price);

            //Set default sell price exc. tax
            $variation_details->default_sell_price = $variation_data['default_sell_price'];

            //set profit margin
            $variation_details->profit_percent = $this->get_percent($variation_details->default_purchase_price, $variation_details->default_sell_price);

            //set sell price inc. tax
            $variation_details->sell_price_inc_tax = $this->calc_percentage($variation_details->default_sell_price, $tax_rate, $variation_details->default_sell_price);

            $variation_details->save();
        }
    }

    /**
     * Generated SKU based on the barcode type.
     *
     * @param string $sku
     * @param string $c
     * @param string $barcode_type
     *
     * @return void
     */
    public function generateSubSku($sku, $c, $barcode_type)
    {
        $sub_sku = $sku . $c;

        if (in_array($barcode_type, ['C128', 'C39'])) {
            $sub_sku = $sku . '-' . $c;
        }

        return $sub_sku;
    }

    /**
     * Add rack details.
     *
     * @param int $business_id
     * @param int $product_id
     * @param array $product_racks
     * @param array $product_racks
     *
     * @return void
     */
    public function addRackDetails($business_id, $product_id, $product_racks)
    {
        if (!empty($product_racks)) {
            $data = [];
            foreach ($product_racks as $location_id => $detail) {
                $data[] = ['business_id' => $business_id,
                        'location_id' => $location_id,
                        'product_id' => $product_id,
                        'rack' => !empty($detail['rack']) ? $detail['rack'] : null,
                        'row' => !empty($detail['row']) ? $detail['row'] : null,
                        'position' => !empty($detail['position']) ? $detail['position'] : null,
                        'created_at' => \Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon::now()->toDateTimeString()
                    ];
            }

            ProductRack::insert($data);
        }
    }

    /**
     * Get rack details.
     *
     * @param int $business_id
     * @param int $product_id
     *
     * @return void
     */
    public function getRackDetails($business_id, $product_id, $get_location = false)
    {
        $query = ProductRack::where('product_racks.business_id', $business_id)
                    ->where('product_id', $product_id);

        if ($get_location) {
            $racks = $query->join('business_locations AS BL', 'product_racks.location_id', '=', 'BL.id')
                ->select(['product_racks.rack',
                        'product_racks.row',
                        'product_racks.position',
                        'BL.name'])
                ->get();
        } else {
            $racks = collect($query->select(['rack', 'row', 'position', 'location_id'])->get());

            $racks = $racks->mapWithKeys(function ($item, $key) {
                return [$item['location_id'] => $item->toArray()];
            })->toArray();
        }

        return $racks;
    }

    /**
     * Update rack details.
     *
     * @param int $business_id
     * @param int $product_id
     * @param array $product_racks
     *
     * @return void
     */
    public function updateRackDetails($business_id, $product_id, $product_racks)
    {
        if (!empty($product_racks)) {
            foreach ($product_racks as $location_id => $details) {
                ProductRack::where('business_id', $business_id)
                    ->where('product_id', $product_id)
                    ->where('location_id', $location_id)
                    ->update(['rack' => !empty($details['rack']) ? $details['rack'] : null,
                            'row' => !empty($details['row']) ? $details['row'] : null,
                            'position' => !empty($details['position']) ? $details['position'] : null
                        ]);
            }
        }
    }

    /**
     * Retrieves selling price group price for a product variation.
     *
     * @param int $variation_id
     * @param int $price_group_id
     * @param int $tax_id
     *
     * @return decimal
     */
    public function getVariationGroupPrice($variation_id, $price_group_id, $tax_id)
    {
        $price_inc_tax =
        VariationGroupPrice::where('variation_id', $variation_id)
                        ->where('price_group_id', $price_group_id)
                        ->value('price_inc_tax');

        $price_exc_tax = $price_inc_tax;
        if (!empty($price_inc_tax) && !empty($tax_id)) {
            $tax_amount = TaxRate::where('id', $tax_id)->value('amount');
            $price_exc_tax = $this->calc_percentage_base($price_inc_tax, $tax_amount);
        }
        return [
            'price_inc_tax' => $price_inc_tax,
            'price_exc_tax' => $price_exc_tax
        ];
    }

    /**
     * Tambah/Edit Transaksi Pembelian
     *
     * @param object $transaksi
     * @param array $pembelian_data
     * @param array $currency_details
     * @param boolean $enable_product_editing
     * @param string $status_sebelumnya = null
     *
     * @return array
     */
    public function createOrUpdatePembelian($transaksi, $pembelian_data, $status_sebelumnya = null)
    {
        $update_pembelian = [];
        $update_pembelian_id = [0];

        foreach ($pembelian_data as $data => $d) {
            $qty = $d['qty'];
            //update existing purchase line
            if (isset($d['pembelian_id'])){
                $pembelian = Pembelian::findOrFail($d['pembelian_id']);
                $update_pembelian_id[] = $pembelian->id;
                $old_qty = $this->num_f($pembelian->quantity);

                //Update quantity for existing products
                if ($status_sebelumnya == 'diterima' && $transaksi->status == 'diterima') {
                    //if status received update existing quantity
                    $this->updateProdukQty($transaksi->location_id, $d['product_id'], $d['variation_id'], $new_quantity_f, $old_qty, $currency_details);
                } elseif ($status_sebelumnya == 'diterima' && $transaksi->status != 'diterima') {
                    //decrease quantity only if status changed from received to not received
                    $this->decreaseProductQuantity(
                        $d['produk_id'],
                        $d['variasi_id'],
                        $transaksi->toko_id,
                        $pembelian->quantity
                    );
                } elseif ($status_sebelumnya != 'diterima' && $transaksi->status == 'diterima') {
                    $this->updateProdukQty($transaksi->location_id, $d['product_id'], $d['variation_id'], $new_quantity_f, 0, $currency_details);
                }
            } else {
                //Buat Data Pembelian Baru
                $pembelian = new Pembelian();
                $pembelian->transaksi_id = $transaksi->id;
                $pembelian->produk_id = $d['produk_id'];
                $pembelian->variasi_id = $d['variasi_id'];

                //Increase quantity only if status is received
                if ($transaksi->status == 'diterima') {
                    $this->updateProdukQty($transaksi->bisnis_id, $transaksi->outlet_id, $d['produk_id'], $d['variasi_id'], $qty, 0);
                }
            }

            $pembelian->quantity = $qty;
            $pembelian->hrg_beli = $d['harga'];
            $pembelian->sub_total = $d['total'];

            $update_pembelian[] = $pembelian;
        }

        // dd($update_pembelian);
        //unset deleted purchase lines
        $hapus_pembelian_id = [];
        $hapus_pembelian = null;
        if (!empty($update_pembelian_id)) {
            $hapus_pembelian = Pembelian::where('transaksi_id', $transaksi->id)
                    ->whereNotIn('id', $update_pembelian_id)
                    ->get();

            if ($hapus_pembelian->count()) {
                foreach ($hapus_pembelian as $hapus_data) {
                    $hapus_pembelian_id[] = $hapus_data->id;

                    //decrease deleted only if previous status was received
                    if ($status_sebelumnya == 'received') {
                        $this->decreaseProductQuantity(
                            $hapus_data->product_id,
                            $hapus_data->variation_id,
                            $transaksi->toko_id,
                            $hapus_data->quantity
                    );
                    }
                }
                //Delete deleted purchase lines
                Pembelian::where('transaksi_id', $transaksi->id)
                        ->whereIn('id', $hapus_pembelian_id)
                        ->delete();
            }
        }

        //update purchase lines
        if (!empty($update_pembelian)) {
            // Pembelian::insert($update_pembelian);
            $transaksi->pembelian()->saveMany($update_pembelian);
        }

        return $hapus_pembelian;
    }

    /**
     * Recalculates purchase line data according to subunit data
     *
     * @param integer $business_id
     * @param integer $unit_id
     *
     * @return array
     */
    public function changePurchaseLineUnit($purchase_line)
    {
        $base_unit = $purchase_line->product->unit;
        $sub_units = $base_unit->sub_units;

        $sub_unit_id = $purchase_line->sub_unit_id;

        $sub_unit = $sub_units->filter(function ($item) use ($sub_unit_id) {
            return $item->id == $sub_unit_id;
        })->first();

        if (!empty($sub_unit)) {
            $multiplier = $sub_unit->base_unit_multiplier;
            $purchase_line->quantity = $purchase_line->quantity / $multiplier;
            $purchase_line->pp_without_discount = $purchase_line->pp_without_discount * $multiplier;
            $purchase_line->purchase_price = $purchase_line->purchase_price * $multiplier;
            $purchase_line->purchase_price_inc_tax = $purchase_line->purchase_price_inc_tax * $multiplier;
            $purchase_line->item_tax = $purchase_line->item_tax * $multiplier;
            $purchase_line->quantity_returned = $purchase_line->quantity_returned / $multiplier;
            $purchase_line->quantity_sold = $purchase_line->quantity_sold / $multiplier;
            $purchase_line->quantity_adjusted = $purchase_line->quantity_adjusted / $multiplier;
        }

        return $purchase_line;
    }

    /**
     * Recalculates sell line data according to subunit data
     *
     * @param integer $unit_id
     *
     * @return array
     */
    public function changeSellLineUnit($business_id, $sell_line)
    {
        $unit_details = $this->getSubUnits($business_id, $sell_line->unit_id);

        $sub_unit = null;
        $sub_unit_id = $sell_line->sub_unit_id;
        foreach ($unit_details as $key => $value) {
            if ($key == $sub_unit_id) {
                $sub_unit = $value;
            }
        }

        if (!empty($sub_unit)) {
            $multiplier = $sub_unit['multiplier'];
            $sell_line->quantity_ordered = $sell_line->quantity_ordered / $multiplier;
            $sell_line->item_tax = $sell_line->item_tax * $multiplier;
            $sell_line->default_sell_price = $sell_line->default_sell_price * $multiplier;
            $sell_line->unit_price_before_discount = $sell_line->unit_price_before_discount * $multiplier;
            $sell_line->sell_price_inc_tax = $sell_line->sell_price_inc_tax * $multiplier;
            $sell_line->sub_unit_multiplier = $multiplier;

            $sell_line->unit_details = $unit_details;
        }

        return $sell_line;
    }

    /**
     * Retrieves current stock of a variation for the given location
     *
     * @param int $variation_id, int location_id
     *
     * @return float
     */
    public function getCurrentStock($variation_id, $location_id)
    {
        $current_stock = VariationLocationDetails::where('variation_id', $variation_id)
                                              ->where('location_id', $location_id)
                                              ->value('qty_available');

        if (null == $current_stock) {
            $current_stock = 0;
        }
        return $current_stock;
    }

    /**
     * Adjusts stock over selling with purchases, opening stocks andstock transfers
     * Also maps with respective sells
     *
     * @param obj $transaction
     *
     * @return void
     */
    public function adjustStockOverSelling($transaction)
    {
        if ($transaction->status != 'received') {
            return false;
        }

        foreach ($transaction->purchase_lines as $purchase_line) {
            if ($purchase_line->product->enable_stock == 1) {

        //Available quantity in the purchase line
                $purchase_line_qty_avlbl = $purchase_line->quantity_remaining;

                if ($purchase_line_qty_avlbl <= 0) {
                    continue;
                }

                //update sell line purchase line mapping
                $sell_line_purchase_lines =
        TransactionSellLinesPurchaseLines::where('purchase_line_id', 0)
                ->join('transaction_sell_lines as tsl', 'tsl.id', '=', 'transaction_sell_lines_purchase_lines.sell_line_id')
                ->join('transactions as t', 'tsl.transaction_id', '=', 't.id')
                ->where('t.location_id', $transaction->location_id)
                ->where('tsl.variation_id', $purchase_line->variation_id)
                ->where('tsl.product_id', $purchase_line->product_id)

                ->select('transaction_sell_lines_purchase_lines.*')
                ->get();

                foreach ($sell_line_purchase_lines as $slpl) {
                    if ($purchase_line_qty_avlbl > 0) {
                        if ($slpl->quantity <= $purchase_line_qty_avlbl) {
                            $purchase_line_qty_avlbl -= $slpl->quantity;
                            $slpl->purchase_line_id = $purchase_line->id;
                            $slpl->save();
                            //update purchase line quantity sold
                            $purchase_line->quantity_sold += $slpl->quantity;
                            $purchase_line->save();
                        } else {
                            $diff = $slpl->quantity - $purchase_line_qty_avlbl;
                            $slpl->purchase_line_id = $purchase_line->id;
                            $slpl->quantity = $purchase_line_qty_avlbl;
                            $slpl->save();

                            //update purchase line quantity sold
                            $purchase_line->quantity_sold += $slpl->quantity;
                            $purchase_line->save();

                            TransactionSellLinesPurchaseLines::create([
                'sell_line_id' => $slpl->sell_line_id,
                'purchase_line_id' => 0,
                'quantity' => $diff
              ]);
                            break;
                        }
                    }
                }
            }
        }
    }

    /**
     * Finds out most relevant descount for the product
     *
     * @param obj $product, int $business_id, int $location_id, bool $is_cg,
     * bool $is_spg
     *
     * @return obj discount
     */
    public function getProductDiscount($product, $business_id, $location_id, $is_cg = false, $is_spg = false)
    {
        $now = \Carbon::now()->toDateTimeString();

        //Search if both category and brand matches
        $query1 = Discount::where('business_id', $business_id)
                    ->where('location_id', $location_id)
                    ->where('is_active', 1)
                    ->where('starts_at', '<=', $now)
                    ->where('ends_at', '>=', $now)
                    ->where('brand_id', $product->brand_id)
                    ->where('category_id', $product->category_id)
                    ->orderBy('priority', 'desc')
                    ->latest();
        if ($is_cg) {
            $query1->where('applicable_in_cg', 1);
        }
        if ($is_spg) {
            $query1->where('applicable_in_spg', 1);
        }

        $discount = $query1->first();

        //Search if either category or brand matches
        if (empty($discount)) {
            $query2 = Discount::where('business_id', $business_id)
                    ->where('location_id', $location_id)
                    ->where('is_active', 1)
                    ->where('starts_at', '<=', $now)
                    ->where('ends_at', '>=', $now)
                    ->where(function ($q) use ($product) {
                        $q->whereRaw('(brand_id="' . $product->brand_id .'" AND category_id IS NULL)')
                        ->orWhereRaw('(category_id="' . $product->category_id .'" AND brand_id IS NULL)');
                    })
                    ->orderBy('priority', 'desc');
            if ($is_cg) {
                $query2->where('applicable_in_cg', 1);
            }
            if ($is_spg) {
                $query2->where('applicable_in_spg', 1);
            }
            $discount = $query2->first();
        }

        if (!empty($discount)) {
            $discount->formated_starts_at = $this->format_date($discount->starts_at->toDateTimeString(), true);
            $discount->formated_ends_at = $this->format_date($discount->ends_at->toDateTimeString(), true);
        }

        return $discount;
    }
}
