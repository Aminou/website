<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepo;
use Illuminate\Http\Request;
use View;
use Auth;

class UserController extends Controller
{
    protected $usersRepo;

    public function __construct(UsersRepo $usersRepo)
    {
        $this->usersRepo = $usersRepo;
    }

    public function index()
    {
        return $this->usersRepo->all();
    }

    public function show($id)
    {
        return $this->usersRepo->find($id);
    }

    public function update(Request $request, $id)
    {
        $user = $this->usersRepo->find($id);

        if (Auth::user()->can('update', $user)) {

            if ($request->method() === 'POST') {
                $update = $this->usersRepo->update($id, $request->toArray());
            }

            return $user;
        }

        dd('oops');
        //return View::make('users.update', compact($user));
    }

    public function delete($id)
    {
        $user = $this->usersRepo->find($id);

        if (Auth::user()->can('delete', $user)) {
            return $this->usersRepo->delete($id);
        }
    }


}
