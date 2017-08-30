@extends('layouts.app')


@section('content')

    <section class="myself">

        <h1>{{ $jobseeker->name }}</h1>

        <p>
            {{ $jobseeker->job_title }}
        </p>

        <div class="address">
            {{ $jobseeker->address }}
        </div>

        <div class="coordonnees">
            {{ $jobseeker->phone }}
            {{ $jobseeker->email }}
        </div>

    </section>

@if($jobs)
    <section class="jobs">
        @each('template.job', $jobs, 'job')
    </section>
@endif


@if($skills)
    <section class="skills">
        @each('template.skill', $skills, 'skill')
    </section>
@endif

@if($tools)
    <section class="tools">
        @each('template.tool', $tools, 'tool')
    </section>
@endif

@endsection