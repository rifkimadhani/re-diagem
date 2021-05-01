<?php
namespace App\Repository\Interfaces;

use App\Models\Transaksi;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface TransaksiRepositoryInterface
{
//    public function all(): Collection;
    public function transaksiCreate(array $attributes): Model;
    public function getall(): ?Collection;
    public function bayarCreate(array $attributes);
    public function getPenjualan($per_page, $start, $end);
    public function getPenjualanKotor($start, $end);
    public function getPembelian($per_page, $start, $end);
    public function getJumlahPembelian($start, $end);
    public function getPembelianItems($transaksi_id);
    public function getReturPembelian($per_page, $start, $end);
    public function getReturJumlahPembelian($start, $end);
    public function getReturPembelianItems($transaksi_id);
}
