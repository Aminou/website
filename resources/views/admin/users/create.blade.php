@extends('layouts.app')

@section('content')
    <section class="container">

        <h1>Mon Compte</h1>

        <form class="form-horizontal" action="{{ Request::url() }}" method="post">

            <div class="row">

            <div class="col-md-5">

            <div class="form-group">
                <input class="form-control" type="text" placeholder="Firstname" name="firstname" required @if($user) value="{{  $user->firstname }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="Position" name="lastname" required @if($user) value="{{  $user->lastname }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="email" placeholder="email" name="email" required @if($user) value="{{  $user->email }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="job_title" name="job_title" @if($user) value="{{  $user->job_title }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="address" name="address" @if($user) value="{{  $user->address }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="postcode" name="postcode" @if($user) value="{{  $user->postcode }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="city" name="city" @if($user) value="{{ $user->city }}"@endif>
            </div>

            <div class="form-group">
                <input class="form-control" type="text" placeholder="phone" name="phone" @if($user) value="{{ $user->phone }}"@endif>
            </div>

            </div>

            <div class="col-md-7 pl5">
                <div class="form-group">
                    <textarea class="form-control h100"  rows="15" placeholder="About me" name="about_me">@if($user) {{ $user->about_me }}@endif</textarea>
                </div>
            </div>

            </div>
            {{ csrf_field() }}
            <button class="btn btn-default">Send</button>

        </form>

    </section>
@endsection