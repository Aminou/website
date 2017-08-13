<?php

namespace App\Http\Controllers;

use App\User;

class CurriculumController extends Controller
{
    public function index(User $user)
    {
        $this->data['jobs'] = $user->jobs;
        $this->data['skills'] = $user->skills;
        $this->data['tools'] = $user->tools;

        return $this->view('cv');
    }
}
