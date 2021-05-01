<?php

namespace App\Repository;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Session;
class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
     protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
    * @param $id
    * @return Model
    */
    public function MitraGet()
    {
        return $this->model->where('bisnis_id', $this->bisnis_id)
        ->orderBy('created_at', 'DESC')->get();
    }

    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function MitraCreate(array $attributes): Model
    {
        $bisnis_id = Session::get('bisnis.bisnis_id');
        $attributes['bisnis_id'] = $bisnis_id;
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function update(array $attributes): Model
    {
        return $this->model->update($attributes);
    }
}
