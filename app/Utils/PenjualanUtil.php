<?php

namespace App\Utils;

use App\Models\Toko_id;

use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\VariasiDetail;
use App\Models\Penjualan;
use App\Models\Transaksi;
use App\TransactionSellLinesPurchaseLines;
use App\Unit;
use Illuminate\Support\Facades\DB;

class PenjualanUtil extends Util
{
/**
     * Tambah/Edit Transaksi Penjualan
     *
     * @param object/int $transaksi
     * @param array $penjualan
     * @param array $outlet_id
     * @param boolean $return_deleted = false
     * @param array $extra_line_parameters = []
     *   Example: ['database_trasnaction_linekey' => 'products_line_key'];
     *
     * @return boolean/object
     */
    public function PenjualanCreateUpdate($transaksi, $produkJual, $return_deleted = false, $status_before = null, $extra_line_parameters = [])
    {
        $lines_formatted = [];
        $modifiers_array = [];
        $edit_ids = [0];
        $modifiers_formatted = [];
        $combo_lines = [];
        $products_modified_combo = [];
        foreach ($produkJual as $produk) {
            $multiplier = 1;

            //Check if transaction_sell_lines_id is set, used when editing.
            if (!empty($produk['penjualan_id'])) {
                $edit_ids[] = $produk['penjualan_id'];

                $this->editPenjualan($produk, $transaksi->toko_id, $status_before, $multiplier);

                //update or create modifiers for existing sell lines
            } else {
                $products_modified_combo[] = $produk;

                //calculate unit price and unit price before discount
                $line = [
                    'produk_id' => $produk['produk_id'],
                    'variasi_id' => $produk['variasi_id'],
                    'quantity' =>  $produk['qty'],
                    'hrg_jual' => $produk['hrg_jual'],
                    'sub_total' => $produk['hrg_jual'] * $produk['qty'],
                ];

                foreach ($extra_line_parameters as $key => $value) {
                    $line[$key] = isset($produk[$value]) ? $produk[$value] : '';
                }

                if (!empty($produk['lot_no_line_id'])) {
                    $line['lot_no_line_id'] = $produk['lot_no_line_id'];
                }

                $lines_formatted[] = new Penjualan($line);
            }
        }

        // if (!is_object($transaksi)) {
        //     $transaksi = Transaksi::findOrFail($transaksi);
        // }

        //Delete the products removed and increment product stock.
        // $deleted_lines = [];
        // if (!empty($edit_ids)) {
        //     $deleted_lines = TransactionSellLine::where('transaction_id', $transaction->id)
        //             ->whereNotIn('id', $edit_ids)
        //             ->whereNull('parent_sell_line_id')
        //             ->select('id')->get()->toArray();
        //     $combo_delete_lines = TransactionSellLine::whereIn('parent_sell_line_id', $deleted_lines)->where('children_type', 'combo')->select('id')->get()->toArray();
        //     $deleted_lines = array_merge($deleted_lines, $combo_delete_lines);

        //     $adjust_qty = $status_before == 'draft' ? false : true;

        //     $this->deleteSellLines($deleted_lines, $location_id, $adjust_qty);
        // }

        if (!empty($lines_formatted)) {
            $transaksi->penjualan()->saveMany($lines_formatted);
        }

        if ($return_deleted) {
            return $deleted_lines;
        }
        return true;
    }




}
