@extends('layouts.app')


@section('content')

    <section class="myself">

        <div class="img"><img src="{{ optional($user->avatar)->url }}" alt="{{ $jobseeker->name }}" /></div>
        <h1>{{ $jobseeker->name }}</h1>

        <h2>{{ $jobseeker->job_title }}</h2>

        <div class="address">
            {{ $jobseeker->address }}
        </div>

        <div class="coordonnees">
            {{ $jobseeker->phone }}
            {{ $jobseeker->email }}
        </div>

    </section>

@if($jobseeker->about_me)
    <section class="about">
        <p>{{ $jobseeker->about_me }}</p>
    </section>
@endif


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