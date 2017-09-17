<article class="post mt0">
    <h2><a href="posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
    <p>
        {{ $post->body }}
    </p>

    <footer>
        <span>{{$post->author->name}}</span>, <span>{{ $post->published_at->diffForHumans() }}</span>
    </footer>
</article>