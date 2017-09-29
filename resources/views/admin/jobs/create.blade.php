@extends('layouts.app')

@section('content')
        <form action="{{ Request::url() }}" method="post">
            {{ csrf_field() }}

            <input type="text" placeholder="Title" name="title" required>
            <input type="text" placeholder="Position" name="job_title" required>
            <input type="text" placeholder="Company" name="company" required>
            <input type="text" placeholder="Url" name="url">
            <input type="date" placeholder="Start date" name="start_date">
            <input type="date" placeholder="End date" name="end_date">

            <label for="type">
                Type:
               <input type="radio" name="type" value="cdi" checked required>
               <input type="radio" name="type" value="contract" required>
               <input type="radio" name="type" value="freelance" required>
            </label>

            <label for="description">Description
                 <textarea name="description"></textarea>
            </label>

            <button class="btn btn-default">Send</button>
        </form>
@endsection