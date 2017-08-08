<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository
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
     * Return fresh query on the model
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
     * @param bool  $returnID set to true to return only the id.
     *
     * @return mixed
     */
    public function create(array $data, $returnID = false)
    {
        $new = $this->model->create($data);

        if ($returnID) {
            return $new->getKey();
        }

        return $new;
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

    /**
     * Disable the model
     *
     * @param int $id ID
     *
     * @return mixed
     */
    public function disable($id)
    {
        return $this->_setActiveStatus($id, 0);
    }

    /**
     * Activate the model
     *
     * @param int $id ID
     *
     * @return mixed
     */
    public function activate($id)
    {
        return $this->_setActiveStatus($id, 1);
    }

    /**
     * Change the active status
     *
     * @param int $id ID
     * @param int $status 1 to activate, 0 to disable
     *
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    private function _setActiveStatus($id, $status)
    {
        return $this->update($id, ['active' => $status]);
    }
}
