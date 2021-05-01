<?php

namespace App\Repository\Eloquent;

use App\Models\TransaksiBayar;
use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Repository\Interfaces\TransaksiRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;
use Session;

class TransaksiRepository extends BaseRepository implements TransaksiRepositoryInterface
{

   /**
    * TransaksiRepository constructor.
    *
    * @param User $model
    */
    public function __construct(Transaksi $model, TransaksiBayar  $bayar, Pembelian $beli, Penjualan $jual)
    {
        parent::__construct($model);
        $this->bayar = $bayar;
        $this->beli = $beli;
        $this->jual = $jual;
    }

   /**
    * @return Collection
    */
    public function transaksiCreate(array $attributes): Model
    {
        $attributes['bisnis_id'] = Session::get('bisnis.bisnis_id');
        $attributes['outlet_id'] = Session::get('bisnis.outlet_id');
        $attributes['dibuat_oleh'] = Session::get('mitra.id');
        return $this->model->create($attributes);
    }

    public function bayarCreate(array $attributes)
    {
        return $this->bayar->create($attributes);
    }

    public function getBayar($transaksi_id)
    {
        return $this->bayar->where('transaksi_id', $transaksi_id)->get();
    }

    public function getall(): ?Collection
    {
        return $this->model->all();
    }

    public function getPenjualan($per_page, $start, $end)
    {
        return $this->model->where('tipe', 'jual')
        ->whereBetween('created_at', [$start, $end])
        ->paginate($per_page);
    }

    public function getPenjualanItems($transaksi_id)
    {
        return $this->jual->where('transaksi_id', $transaksi_id)->get();
    }

    public function getPenjualanKotor($start, $end)
    {
        return 'Rp '.number_format($this->model->where('tipe', 'jual')
        ->whereBetween('created_at', [$start, $end])
        ->sum('final_total'),0,",",".");
    }

    public function getPembelian($per_page, $start, $end)
    {
        return $this->model->where('tipe', 'beli')
        ->where('bisnis_id', Session::get('bisnis.bisnis_id'))
        ->where('outlet_id', Session::get('bisnis.outlet_id'))
        ->whereBetween('created_at', [$start, $end])
        ->paginate($per_page);
    }

    public function getPembelianItems($transaksi_id)
    {
        return $this->beli->where('transaksi_id', $transaksi_id)->get();
    }

    public function getJumlahPembelian($start, $end)
    {
        return 'Rp '.number_format($this->model->where('tipe', 'beli')->whereBetween('created_at', [$start, $end])->sum('final_total'),0,",",".");
    }

    public function getReturPembelian($per_page, $start, $end)
    {
        return $this->model->where('tipe', 'retur_beli')
        ->where('bisnis_id', Session::get('bisnis.bisnis_id'))
        ->where('outlet_id', Session::get('bisnis.outlet_id'))
        ->whereBetween('created_at', [$start, $end])
        ->paginate($per_page);
    }

    public function getReturPembelianItems($transaksi_id)
    {
        return $this->beli->where('transaksi_id', $transaksi_id)->get();
    }

    public function getReturJumlahPembelian($start, $end)
    {
        return 'Rp '.number_format($this->model->where('tipe', 'retur_beli')->whereBetween('created_at', [$start, $end])->sum('final_total'),0,",",".");
    }

}
