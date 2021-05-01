<?php

namespace App\Repository\Eloquent;

use App\Models\Pelanggan;
use App\Repository\Interfaces\PelangganRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;
use Session;
class PelangganRepository extends BaseRepository implements PelangganRepositoryInterface
{

   /**
    * PelangganRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Pelanggan $model)
   {
       parent::__construct($model);
   }

   /**
    * Menampilkan semua data pelanggan
    * @return Eloquent
    */
    public function getAll()
    {
        return $this->model->
        where(function($q) {
            $q->where('bisnis_id', Session::get('bisnis.bisnis_id'))
              ->orWhere('bisnis_id', null);
        })
        ->orderBy('created_at', 'DESC')->get();
    }

    public function getCari($cari)
    {
        return $this->model->where('nama','LIKE',  '%' . $cari .'%')
        ->where(function($q) {
            $q->where('bisnis_id', Session::get('bisnis.bisnis_id'))
              ->orWhere('bisnis_id', null);
        })
        ->orderBy('created_at', 'DESC')->get();
    }

}
