<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Repositories\PostsRepo;
use App\Filters\PostFilters;

class PostController extends Controller
{
    protected $repo;

    public function __construct(PostsRepo $postsRepo)
    {
        $this->repo = $postsRepo;
    }

    public function index(PostFilters $filters)
    {
        $this->setTitle('Posts');

        $posts = $this->repo->query()->live()->filter($filters)->get();

        return $this->view('home', ['posts' => $posts] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if ($this->loggedUser()->can('create', Post::class)) {
            return $this->repo->create($request->toArray());
        }

        return $this->cantDoThis();
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return mixed
     */
    public function show(Post $post)
    {
        $this->setTitle($post->title);

        return $this->view('post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post Post Model (Route Model Binding)
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return $this->view('admin.posts.update', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return mixed
     */
    public function update(Request $request, Post $post)
    {

        if ($this->loggedUser()->can('update', $post)) {
            $update = $this->repo->update($post->getKey(), $request->toArray());

            if ($update) {
                return $post;
            }
        }

        return $this->cantDoThis();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return mixed
     */
    public function destroy(Post $post)
    {
        if ($this->loggedUser()->can('delete', $post)) {

            if ($this->repo->delete($post->getKey())) {
                return 'deleted ' . $post->title;
            }

            return $this->errorWhenTryingToDelete();
        }

        return $this->cantDoThis();
    }

    public function unpublish($id)
    {
        if ($this->loggedUser()->can('unpublish')) {
            return $this->repo->unpublish($id);
        }

        return $this->cantDoThis();
    }

    public function publish(Post $post)
    {
        if ($this->loggedUser()->can('publish', $post)) {
            $this->repo->publish($post->getKey());
            return $post;
        }

        return $this->cantDoThis();
    }
}
