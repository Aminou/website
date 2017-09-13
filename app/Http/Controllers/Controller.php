<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\User;
use View;
use App\Exceptions\CantDoThisException;
use App\Exceptions\CouldNotDeleteException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;
    protected $title;
    protected $user;

    protected function loggedUser() : User
    {
        return Auth::user();
    }

    protected function setUser() : void
    {
        $this->data['user'] = $this->loggedUser();
    }

    protected function setTitle($title) : void
    {
        $this->data['title'] = $title;
    }

    protected function setDescription($description = '') : void
    {
        $this->data['description'] = $description;
    }

    public function view($viewName)
    {
        return View::make($viewName, $this->data);
    }

    public function cantDoThis() : string
    {
        throw new CantDoThisException;
    }

    public function errorWhenTryingToDelete()
    {
        return new CouldNotDeleteException;
    }

}
