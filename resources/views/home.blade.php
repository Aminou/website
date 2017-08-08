@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if($posts)
                        @foreach($posts as $post)
                            <article class="post-container">
                                <h2>{{ $post->title }}</h2>
                                <section class="body">{{ $post->body }}</section>
                                <footer>
                                    <div class="author">{{ $post->author->name }}</div>
                                    <div class="date">{{ $post->created_at->diffForHumans() }}</div>
                                </footer>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
