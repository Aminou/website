<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepo;
use Illuminate\Http\Request;

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

    public function show(User $user)
    {
        if ($this->loggedUser()->can('view', $user)) {
            return $user;
        }

        return $this->cantDoThis();
    }


    public function edit(User $user)
    {

        if ($this->loggedUser()->can('update', $user)) {
            return $user;
        }

        return $this->cantDoThis();

    }

    public function update(User $user, Request $request)
    {
        if ($this->loggedUser()->can('update', $user)) {
            $user->update($request->toArray());
            return 'update successful';
        }

        return $this->cantDoThis();
    }

    public function delete(User $user)
    {

        if ($this->loggedUser()->can('delete', $user)) {
            return $user->delete();
        }

        return $this->cantDoThis();
    }

}
