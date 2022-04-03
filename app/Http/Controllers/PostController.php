<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $postData = Post::get();
        if(count($postData) == 0)
        {
            return response([
                'msg' => 'Oops! No data found!'
            ], 404);
        }

        return response($postData, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'postTitle' => 'required',
            'postContent' => 'required',
        ]);

        Post::create([
            'postTitle' => $request->postTitle,
            'postContent' => $request->postContent
        ]);

        return response([
            'msg' => 'Post created!'
        ], 201);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if(empty($post))
        {
            return response([
                'msg' => 'No post like that!'
            ], 404);
        }

        return reponse($post, 200);
    }

    public function update(Request $request, $id)
    {
        Post::where('id', $id)->update([
            'postTitle' => $request->postTitle,
            'postContent' => $request->postContent,
        ]);

        return response([
            'msg' => 'The post updated!'
        ], 200);
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return response([
            'msg' => 'The post deleted!'
        ], 200);
    }
}
