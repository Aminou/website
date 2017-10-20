<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\UsersRepo;

class CurriculumController extends Controller
{
    public function index(User $user)
    {
        return $this->view('cv', [
            'jobs' => $user->jobs,
            'skills' => $user->skills,
            'tools' => $user->tools,
            'jobseeker' => $user
        ]);
    }

    public function myCuriculum(UsersRepo $repo)
    {
       return $this->index($repo->find(1));
    }



}
