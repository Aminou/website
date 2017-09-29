<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->setTitle('Backoffice');

    }

    public function index()
    {
        return $this->view('admin.home');
    }
}
