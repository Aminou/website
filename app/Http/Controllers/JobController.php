<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\JobsRepo;
use App\Job;
use View;

class JobController extends Controller
{

    public function __construct(JobsRepo $repo)
    {
        $this->repo = $repo;
        $this->setTitle('Jobs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('jobs', ['jobs' => $this->repo->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setTitle('Add a job');
        return $this->view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
           'title', 'job_title', 'company', 'url', 'start_date', 'end_date', 'type', 'description'
        ]);

        $data['user_id'] = $this->loggedUser()->id;

        $job = $this->repo->create($data);

        $this->setTitle($job->title);

        return $this->view('job', ['job' => $job]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $this->setTitle($job->slug);

        return $this->view('job', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repo->delete($id);
    }
}
