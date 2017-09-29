@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <article class="post mt0">
                            <h2>{{ $post->title }}</h2>

                            <p class="mt10">
                                {{ $post->body }}
                            </p>

                            <footer class="mt10">
                                <span>{{$post->author->name}}</span>, <span>{{ $post->published_at->diffForHumans() }}</span>
                            </footer>
                        </article>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection