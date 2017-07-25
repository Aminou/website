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

    public function show($id)
    {
        $user = $this->getUserInfo($id);
        if ($this->loggedUser()->can('view', $user)) {
            return $user;
        }

        return $this->cantDoThis();
    }


    public function edit($id)
    {
        $user = $this->getUserInfo($id);
        if ($this->loggedUser()->can('update', $user)) {
            return $user;
        }

    }

    public function update(Request $request, $id)
    {
        $user = $this->getUserInfo($id);

        if ($this->loggedUser()->can('update', $user)) {
            $this->usersRepo->update($id, $request->toArray());
            return 'update successful';
        }

        return $this->cantDoThis();
    }

    public function delete($id)
    {
        $user = $this->getUserInfo($id);

        if ($this->loggedUser()->can('delete', $user)) {
            return $this->usersRepo->delete($id);
        }
    }

    /**
     * @param $id
     */
    private function getUserInfo($id)
    {
        return $this->usersRepo->find($id);
    }

}
