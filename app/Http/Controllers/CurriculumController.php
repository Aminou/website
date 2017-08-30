<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepo;
use App\User;

class CurriculumController extends Controller
{
    public function index(User $user)
    {
        $this->data['jobs'] = $user->jobs;
        $this->data['skills'] = $user->skills;
        $this->data['tools'] = $user->tools;
        $this->data['jobseeker'] = $user;

        return $this->getView();
    }

    public function myCuriculum(UsersRepo $repo)
    {
        $me = $repo->find(1);

        $this->data['jobs'] = $me->jobs;
        $this->data['skills'] = $me->skills;
        $this->data['tools'] = $me->tools;
        $this->data['jobseeker'] = $me;

        return $this->getView();
    }

    public function getView()
    {
        return $this->view('cv');
    }
}
