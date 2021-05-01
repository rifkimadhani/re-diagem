<?php

namespace App\Repository\Eloquent;

use App\Models\Outlet;
use App\Repository\Interfaces\OutletRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;

class OutletRepository extends BaseRepository implements OutletRepositoryInterface
{
   /**
    * OutletRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Outlet $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
    public function getAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

}
