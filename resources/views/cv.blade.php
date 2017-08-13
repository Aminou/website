@extends('layouts.app')


@section('content')


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