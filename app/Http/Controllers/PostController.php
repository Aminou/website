<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostsRepo;
use App\Post;
use View;
use Auth;

class PostController extends Controller
{
    protected $repo;

    public function __construct(PostsRepo $postsRepo)
    {
        $this->repo = $postsRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $this->setTitle('Home');

        $this->data['posts'] = $this->repo->query()->live()->orderBy('published_at', 'DESC')->get();
        return View::make('home', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
