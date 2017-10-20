@extends('layouts.app')

@section('content')

    <section class="container">

        <h1>Outils</h1>

        <form class="form-horizontal" action="{{ Request::url() }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

            <div class="row">

                <div class="col-md-5">

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Title" name="title" required>
                    </div>

                </div>

                <div class="col-md-7">
                    <div class="form-group pl4">
                        <textarea class="form-control" placeholder="Description" rows="12" name="description"></textarea>
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