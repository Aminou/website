<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Exceptions\CantDoThisException;
use App\Exceptions\CouldNotDeleteException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;
    protected $title;
    protected $user;

    protected function loggedUser()
    {
        return Auth::user();
    }

    protected function setUser() : void
    {
        $this->addDataToView(['user' =>  $this->loggedUser()]);
    }

    protected function setTitle($title) : void
    {
        $this->addDataToView(['title' => $title]);
    }

    protected function setDescription($description = '') : void
    {
        $this->addDataToView(['description' => $description]);
    }

    public function view($viewName, array $additionnalData = [])
    {
        $this->addDataToView($additionnalData);
        $this->setUser();

        return View::make($viewName, $this->data);
    }

    protected function addDataToView(array $data = []) : void
    {
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $this->data[$key] = $value;
            }
        }
    }

    protected function cantDoThis() : CantDoThisException
    {
        throw new CantDoThisException;
    }

    protected function errorWhenTryingToDelete() : CouldNotDeleteException
    {
        return new CouldNotDeleteException;
    }

}
