<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\User;

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

    public function cantDoThis() : string
    {
        return 'You can\'t do this.';
    }

    public function setUser() : void
    {
        $this->data['user'] = $this->loggedUser();
    }

    public function setTitle($title) : void
    {
        $this->data['title'] = $title;
    }

    public function setDescription($description = '') : void
    {
        $this->data['description'] = $description;
    }

}
