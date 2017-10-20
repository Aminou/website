@extends('layouts.app')

@section('content')

    <section class="container">

        <h1>Mes emplois</h1>

        <form class="form-horizontal" action="{{ Request::url() }}" method="post">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-5">

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Title" name="title" required
                        @if($job) value="{{ $job->title }}"@endif
                        >
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Position" name="job_title" required
                        @if($job) value="{{ $job->job_title }}"@endif>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Company" name="company" required
                        @if($job) value="{{ $job->company }}"@endif>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Url" name="url"
                        @if($job) value="{{ $job->url }}"@endif>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="date" placeholder="Start date" name="start_date"
                         @if($job) value="{{ $job->start_date }}"@endif>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="date" placeholder="End date" name="end_date"
                        @if($job) value="{{ $job->end_date }}"@endif>
                    </div>

                    <div class="form-group">

                        <div class="radio">
                            <label for="type">
                           <input type="radio" name="type" value="cdi" checked required>
                            cdi
                            </label>
                        </div>

                        <div class="radio">
                            <label for="type">
                            <input type="radio" name="type" value="contract" required>
                                cdd
                            </label>
                        </div>

                        <div class="radio">
                            <label for="type">
                            <input type="radio" name="type" value="freelance" required>
                                freelance
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-md-7">
                    <div class="form-group pl4">
                        <textarea class="form-control" placeholder="Description" rows="12" name="description">
                            @if($job) {{ $job->description }} @endif
                        </textarea>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="from-group">
                    <button class="btn btn-default">Send</button>
                </div>
            </div>

        </form>

    </section>
@endsection