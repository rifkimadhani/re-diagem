<?php

namespace App\Repository\Eloquent;

use App\Models\Supplier;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;
use App\Repository\Interfaces\SupplierRepositoryInterface;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{

   /**
    * SupplierRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Supplier $model)
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
        return $this->model->where('bisnis_id', Session::get('bisnis.bisnis_id'))->orderBy('created_at', 'DESC')->get();
    }

}
