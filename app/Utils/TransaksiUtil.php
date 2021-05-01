<?php

namespace App\Utils;

use App\Models\Toko_id;

use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\VariasiDetail;
use App\Models\Penjualan;
use App\Models\Transaksi;
use App\Models\TransaksiBayar;
use App\TransactionSellLinesPurchaseLines;
use App\Unit;
use Illuminate\Support\Facades\DB;

class TransaksiUtil extends Util
{
    /**
     * Mendapatkan Total Pembelian Berdasarkan Periode Tanggal Tertentu
     *
     * @param int $bisnis_id
     * @param int $transaksi_id
     *
     * @return array
     */
    public function getTotalPembelian($bisnis_id, $tgl_awal = null, $tgl_akhir = null, $outlet_id = null)
    {
        $query = Transaksi::where('bisnis_id', $bisnis_id)
                        ->where('tipe', 'pembelian')
                        ->select(
                            'final_total',
                            DB::raw("(final_total - pajak_nilai) as total_diluar_pajak"),
                            DB::raw("SUM((SELECT SUM(tp.jumlah) FROM transaksi_bayar as tp WHERE tp.transaksi_id=transaksi.id)) as total_dibayar"),
                            DB::raw('SUM(total) as total_tnp_pajak'),
                            // 'kirim_biaya'
                        )
                        ->groupBy('transaksi.id');

        //Check for permitted locations of a user
        // $permitted_locations = auth()->user()->permitted_locations();
        // if ($permitted_locations != 'all') {
        //     $query->whereIn('transaksi.outlet_id', $permitted_locations);
        // }

        if (!empty($start_date) && !empty($tgl_akhir)) {
            $query->whereBetween(DB::raw('date(tgl_transaksi)'), [$start_date, $tgl_akhir]);
        }

        if (empty($start_date) && !empty($tgl_akhir)) {
            $query->whereDate('tgl_transaksi', '<=', $tgl_akhir);
        }

        //Filter by the location
        if (!empty($outlet_id)) {
            $query->where('transaksi.outlet_id', $outlet_id);
        }

        $pembelian = $query->get();

        $output['total_with_pajak'] = $pembelian->sum('final_total');
        // $output['total_purchase_exc_tax'] = $pembelian->sum('total_tnp_pajak');
        $output['total_pembelian_tnp_pajak'] = $pembelian->sum('total_tnp_pajak');
        $output['purchase_due'] = $pembelian->sum('final_total') - $pembelian->sum('total_dibayar');
        $output['total_biaya_kirim'] = $pembelian->sum('pengiriman_biaya');

        return $output;
    }


    /**
     * Gives the total sell amount for a business within the date range passed
     *
     * @param int $bisnis_id
     * @param int $transaction_id
     *
     * @return array
     */
    public function getTotalPenjualan($bisnis_id, $tgl_awal = null, $tgl_akhir = null, $outlet_id = null)
    {
        $query = Transaksi::where('transaksi.bisnis_id', $bisnis_id)
                    ->where('transaksi.tipe', 'jual')
                    ->where('transaksi.status', 'final')
                    ->select(
                        'transaksi.id',
                        'final_total',
                        DB::raw("(final_total - pajak_nilai) as total_exc_pajak"),
                        DB::raw('(SELECT SUM(IF(tp.is_retur = 1, -1*tp.jumlah, tp.jumlah)) FROM transaksi_bayar as tp WHERE tp.transaksi_id = transaksi.id) as total_paid'),
                        DB::raw('SUM(total) as total_before_tax'),
                        'pengiriman_biaya'
                    )
                    ->groupBy('transaksi.id');

        //Cek outlet mitra
        // $permitted_locations = auth()->user()->permitted_locations();
        // if ($permitted_locations != 'all') {
            // $query->whereIn('transaksi.outlet_id', $outlet_id);
        // }

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $query->whereBetween(DB::raw('date(tgl_transaksi)'), [$tgl_awal, $tgl_akhir]);
        }

        if (empty($tgl_awal) && !empty($tgl_akhir)) {
            $query->whereDate('tgl_transaksi', '<=', $tgl_akhir);
        }

        //Filter by the location
        if (!empty($outlet_id)) {
            $query->where('transaksi.outlet_id', $outlet_id);
        }

        if (!empty($dibuat_oleh)) {
            $query->where('transaksi.dibuat_oleh', $dibuat_oleh);
        }

        $sell_details = $query->get();

        $output['total_sell_inc_tax'] = $sell_details->sum('final_total');
        $output['total_sell_exc_tax'] = $sell_details->sum('total');
        $output['total_pengiriman_biaya'] = $sell_details->sum('pengiriman_biaya');
        $output['total_transaksi'] = $sell_details->count();

        return $output;
    }

    /**
     * Menghitung semua transaksi berdasarkan tipe transaksi
     *
     * @param  int $bisnis_id
     * @param  array $tipe_transaksi
     * available types = ['retur_beli', 'retur_jual', 'pengeluaran',
     * 'penyesuaian_stok', 'beli_transfer', 'beli', 'jual']
     * @param  string $start_date = null
     * @param  string $end_date = null
     * @param  int $outlet_id = null
     * @param  int $dibuat_oleh = null
     *
     * @return array
     */
    public function getTotalTransaksi(
        $bisnis_id,
        $tipe_transaksi,
        $start_date = null,
        $end_date = null,
        $outlet_id = null,
        $dibuat_oleh = null
        ) {
        $query = Transaksi::where('bisnis_id', $bisnis_id);

        //Check for permitted locations of a user
        // $permitted_locations = auth()->user()->permitted_locations();
        // if ($permitted_locations != 'all') {
        //     $query->whereIn('transactions.outlet_id', $permitted_locations);
        // }

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween(DB::raw('date(tgl_transaksi)'), [$start_date, $end_date]);
        }

        if (empty($start_date) && !empty($end_date)) {
            $query->whereDate('tgl_transaksi', '<=', $end_date);
        }

        //Filter by the location
        if (!empty($outlet_id)) {
            $query->where('transaksi.outlet_id', $outlet_id);
        }

        //Filter by dibuat_oleh
        if (!empty($dibuat_oleh)) {
            $query->where('transaksi.dibuat_oleh', $dibuat_oleh);
        }

        if (in_array('retur_beli', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='retur_beli', final_total, 0)) as total_beli_return_inc_tax"),
                DB::raw("SUM(IF(transaksi.tipe='retur_beli', total, 0)) as total_beli_retur_exc_tax")
            );
        }

        if (in_array('retur_jual', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='retur_jual', final_total, 0)) as total_sell_return_inc_tax"),
                DB::raw("SUM(IF(transaksi.tipe='retur_jual', total, 0)) as total_sell_return_exc_tax")
            );
        }

        if (in_array('jual_transfer', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='jual_transfer', shipping_charges, 0)) as total_transfer_shipping_charges")

            );
        }

        if (in_array('pengeluaran', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='pengeluaran', final_total, 0)) as total_expense")
            );
        }

        if (in_array('penggajihan', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='penggajihan', final_total, 0)) as total_payroll")
            );
        }

        if (in_array('penyesuaian_stok', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='penyesuaian_stok', final_total, 0)) as total_adjustment"),
                DB::raw("SUM(IF(transaksi.tipe='penyesuaian_stok', jumlah_pengembalian, 0)) as total_recovered")
            );
        }

        if (in_array('beli', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='beli', IF(discount_type = 'percentage', COALESCE(diskon_nilai, 0)*total/100, COALESCE(diskon_nilai, 0)), 0)) as total_purchase_discount")
            );
        }

        if (in_array('jual', $tipe_transaksi)) {
            $query->addSelect(
                DB::raw("SUM(IF(transaksi.tipe='jual' AND transaksi.status='final', IF(diskon_tipe = 'persentase', COALESCE(diskon_nilai, 0)*total/100, COALESCE(diskon_nilai, 0)), 0)) as total_sell_discount"),
                // DB::raw("SUM(IF(transaksi.tipe='jual' AND transaksi.status='final', rp_redeemed_amount, 0)) as total_reward_amount"),
                // DB::raw("SUM(IF(transaksi.tipe='jual' AND transaksi.status='final', round_off_amount, 0)) as total_sell_round_off")
            );
        }

        $transaction_totals = $query->first();
        $output = [];

        if (in_array('retur_beli', $tipe_transaksi)) {
            $output['total_beli_return_inc_tax'] = !empty($transaction_totals->total_beli_return_inc_tax) ?
                $transaction_totals->total_beli_return_inc_tax : 0;

            $output['total_beli_retur_exc_tax'] =
                !empty($transaction_totals->total_beli_retur_exc_tax) ?
                $transaction_totals->total_beli_retur_exc_tax : 0;
        }

        if (in_array('retur_jual', $tipe_transaksi)) {
            $output['total_sell_return_inc_tax'] =
                !empty($transaction_totals->total_sell_return_inc_tax) ?
                $transaction_totals->total_sell_return_inc_tax : 0;

            $output['total_sell_return_exc_tax'] =
                !empty($transaction_totals->total_sell_return_exc_tax) ?
                $transaction_totals->total_sell_return_exc_tax : 0;
        }

        if (in_array('jual_transfer', $tipe_transaksi)) {
            $output['total_transfer_shipping_charges'] =
                !empty($transaction_totals->total_transfer_shipping_charges) ?
                $transaction_totals->total_transfer_shipping_charges : 0;
        }

        if (in_array('pengeluaran', $tipe_transaksi)) {
            $output['total_expense'] =
                !empty($transaction_totals->total_expense) ?
                $transaction_totals->total_expense : 0;
        }

        if (in_array('penggajihan', $tipe_transaksi)) {
            $output['total_payroll'] =
                !empty($transaction_totals->total_payroll) ?
                $transaction_totals->total_payroll : 0;
        }

        if (in_array('penyesuaian_stok', $tipe_transaksi)) {
            $output['total_adjustment'] =
                !empty($transaction_totals->total_adjustment) ?
                $transaction_totals->total_adjustment : 0;

            $output['total_recovered'] =
                !empty($transaction_totals->total_recovered) ?
                $transaction_totals->total_recovered : 0;
        }

        if (in_array('beli', $tipe_transaksi)) {
            $output['total_purchase_discount'] =
                !empty($transaction_totals->total_purchase_discount) ?
                $transaction_totals->total_purchase_discount : 0;
        }

        if (in_array('jual', $tipe_transaksi)) {
            $output['total_sell_discount'] =
                !empty($transaction_totals->total_sell_discount) ?
                $transaction_totals->total_sell_discount : 0;

            // $output['total_reward_amount'] =
            //     !empty($transaction_totals->total_reward_amount) ?
            //     $transaction_totals->total_reward_amount : 0;

            // $output['total_sell_round_off'] =
            //     !empty($transaction_totals->total_sell_round_off) ?
            //     $transaction_totals->total_sell_round_off : 0;
        }

        return $output;
    }


    /**
     * Get total paid amount for a transaction
     *
     * @param int $transaksi_id
     *
     * @return int
     */
    public function getTotalPaid($transaksi_id)
    {
        $total_paid = TransaksiBayar::where('transaksi_id', $transaksi_id)
                ->select(DB::raw('SUM(IF(is_retur = 0, jumlah, jumlah*-1))as total_paid'))
                ->first()
                ->total_paid;

        return $total_paid;
    }

    /**
     * Calculates the payment status and returns back.
     * Menghitung status pembayaran dan kembalian
     *
     * @param int $transaksi_id
     * @param float $dibayar = null
     *
     * @return string
     */
    public function hitungStatusPembayaran($transaksi_id, $dibayar = null)
    {
        $total_paid = $this->getTotalPaid($transaksi_id);

        if (is_null($dibayar)) {
            $dibayar = Transaksi::find($transaksi_id)->final_total;
        }

        $status = 'belum dibayar';
        if ($dibayar <= $total_paid) {
            $status = 'lunas';
        } elseif ($total_paid > 0 && $dibayar > $total_paid) {
            $status = 'sebagian';
        }

        return $status;
    }

    /**
     * Update the payment status for purchase or sell transactions. Returns
     * the status
     * Update status pembayaran untuk transaksi penjualan atau pembelian.
     *
     * @param int $transaksi_id
     *
     * @return string status
     */
    public function updateStatusPembayaran($transaksi_id, $final_amount = null)
    {
        $status = $this->hitungStatusPembayaran($transaksi_id, $final_amount);
        Transaksi::where('id', $transaksi_id)
            ->update(['bayar_status' => $status]);

        return $status;
    }


}
