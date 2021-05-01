<?php

namespace App\Repository\Eloquent;

use App\Models\Mitra;
use App\Repository\Interfaces\PegawaiRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;

class PegawaiRepository extends BaseRepository implements PegawaiRepositoryInterface
{

   /**
    * PegawaiRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Mitra $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
//    public function all(): Collection
//    {
//        return $this->model->all();
//    }
    public function getAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

}
