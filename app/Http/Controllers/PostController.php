<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Handlers\ImageUploadHandler;
use App\Models\Post;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        // 類別

        // 分頁
        $postCount = Post::count();
        $postPerPage = 10;
        $postPages = ceil($postCount / $postPerPage); // ceil()是無條件進位
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1; // 當前頁面：如果沒有帶page參數預設第一頁

        // 總處理
        $posts = Post::orderBy('updated_at', 'desc');
    }


    public function store(CreatePost $request, ImageUploadHandler $uploader)
    {
        $post = new Post([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'star' => 0
        ]);
        $post->save();
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        DB::table('posts')->where('id', $id)->update([
            'class' => $data['class'],
            'context' => $data['context'],
            'updated_at' => now()
        ]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return response()->json(true);
    }
}
