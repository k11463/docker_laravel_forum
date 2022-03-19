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
    public function index(Request $request)
    {
        // 類別
        $currentCategory = isset($request->category) ? $request->category : '電玩相關'; // 如果沒有傳過來category這個參數，預設為電玩相關

        // 分頁
        $postCount = Post::count();
        $postPerPage = 10;
        $postPages = ceil($postCount / $postPerPage); // ceil()是無條件進位
        $currentPage = isset($request->page) ? $request->page : 1;

        // 排序
        $currentSortWith = isset($request->sortWith) ? $request->sortWith : 'created_at';
        $currentSortType = isset($request->sortType) ? $request->sortType : 'desc';

        // 總處理
        $posts = Post::where('category', $currentCategory)
                     ->orderBy($currentSortWith, $currentSortType)
                     ->offset($postPerPage * ($currentPage - 1))
                     ->limit($postPerPage)
                     ->get();

        return response()->json($posts);
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

    public function destroy($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return response()->json(true);
    }
}
