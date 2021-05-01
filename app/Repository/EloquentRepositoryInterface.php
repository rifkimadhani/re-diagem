<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
    public function MitraGet();
   /**
    * @param array $attributes
    * @return Model
    */
   public function MitraCreate(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;
}
