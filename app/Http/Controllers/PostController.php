<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = \request()->validate([
            'category_id' => 'integer',
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = \request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => 'integer',
            'tags' => '',
        ]);

        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        // $post = $post->fresh();
        return redirect()->route('post.show', $post->id);
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function firstOrCreate()
    {
        $post = Post::find(1);

        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some imageblabla.jpg',
            'likes' => 5000,
            'is_published' => 1,
        ];

        $post = Post::firstOrcreate([
            'title' => 'some title phpstorm'
        ], [
            'title' => 'some title phpstorm',
            'content' => 'some content',
            'image' => 'some imageblabla.jpg',
            'likes' => 5000,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'updateorcreate some post',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some imageblabla.jpg',
            'likes' => 500,
            'is_published' => 0,
        ];

        $post = Post::updateOrCreate([

            'title' => 'some title not phpstorm',
        ], [
            'title' => 'some title not phpstorm',
            'content' => 'its not update some content',
            'image' => 'its not update some imageblabla.jpg',
            'likes' => 500,
            'is_published' => 0,
        ]);
        dump($post->content);
        dd(2222);
    }
}
