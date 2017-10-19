<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model The Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Returns a fresh query on the model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }

    /**
     * Get the model by id
     *
     * @param int $id The id of the model
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get all models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create Model
     *
     * @param array $data     Data to create the model
     *
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update the model
     *
     * @param int $id ID
     * @param array $data Data to update the model.
     *
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data = [])
    {
        return $this->find($id)->update($data);
    }

    /**
     * Delete the model
     *
     * @param int $id ID
     *
     * @return mixed
     * @throws \Exception
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function getLastUpdate($id)
    {
        return $this->find($id)->updated_at->diffForHumans();
    }

    public function getCreationDate($id)
    {
        return $this->find($id)->created_at->diffForHumans();
    }

}
