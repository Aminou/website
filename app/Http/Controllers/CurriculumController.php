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

        return $this->view('cv');
    }

    public function myCuriculum(UsersRepo $repo)
    {
       return $this->index($repo->find(1));
    }
}
