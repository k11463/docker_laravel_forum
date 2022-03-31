<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Handlers\ImageUploadHandler;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\CreatePost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(Request $request)
    {
        // 類別
        $currentCategory = isset($request->category) ? $request->category : '';

        // 分頁
        $postCount = Post::count();
        $postPerPage = 10;
        $postPages = ceil($postCount / $postPerPage); // ceil()是無條件進位
        $currentPage = isset($request->page) ? $request->page : 1;

        // 排序
        $currentSortWith = isset($request->sortWith) ? $request->sortWith : 'updated_at';
        $currentSortType = isset($request->sortType) ? $request->sortType : 'desc';

        // 總處理
        $title = $request->title;
        $posts = Post::with(['user']) // with是增加效能的一個方式 可以減少sql指令
                     ->where(function ($query) use ($currentCategory, $title) {
                         if (isset($title)){ // 如果沒有輸入title查詢就直接跳過title找category
                             $query->where('title', 'like', '%'.$title.'%');
                         }
                         if ($currentCategory != ''){
                            $query->where('category', '=', $currentCategory);
                         }
                     })
                     ->orderBy($currentSortWith, $currentSortType)
                     ->offset($postPerPage * ($currentPage - 1))
                     ->limit($postPerPage)
                     ->get();
        $returnPosts = [];
        foreach ($posts as $post) {
            $updated_at = '';
            $hour = $post->updated_at->format('H');
            ($hour >= 12) ? $updated_at = $post->updated_at->format('Y/m/d 下午 h:i') : $updated_at = $post->updated_at->format('Y/m/d 上午 h:i');
            $newPost = [
                'post_id' => $post->id,
                'title' => $post->title,
                'category' => $post->category,
                'content' => $post->content,
                'username' => $post->user->username,
                'popular' => $post->popular,
                'updated_at' => $updated_at,
            ];
            array_push($returnPosts, $newPost);
        }
        return response()->json([
            'posts' => $returnPosts,
            'pages' => $postPages
        ]);
    }

    public function store(CreatePost $request, ImageUploadHandler $uploader)
    {
        Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'popular' => 0,
        ]);
        return response('success', 201);
    }

    public function show($id)
    {
        if ($post = Post::findOrFail($id))
        {
            $updated_at = '';
            $hour = $post->updated_at->format('H');
            ($hour >= 12) ? $updated_at = $post->updated_at->format('Y/m/d 下午 h:i') : $updated_at = $post->updated_at->format('Y/m/d 上午 h:i');
            $returnPost = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'updated_at' => $updated_at,
                'username' => $post->user->username,
                'user_id' => $post->user->id,
                'category' => $post->category
            ];

            return $returnPost;
        }
        else {
            return response('cannot find post', 401);
        }
    }

    public function update(CreatePost $request)
    {
        Post::find($request->id)->update([
            'category' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response('updated success');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return response('deleted success');
    }

    public function replyIndex($id)
    {
        $comments = Comment::where('post_id', $id)->get();
        $return = [];
        foreach($comments as $comment)
        {
            $updated_at = '';
            $hour = $comment->updated_at->format('H');
            ($hour >= 12) ? $updated_at = $comment->updated_at->format('Y/m/d 下午 h:i') : $updated_at = $comment->updated_at->format('Y/m/d 上午 h:i');
            $newComment = [
                'id' => $comment->id,
                'poster' => $comment->user->username,
                'poster_id' => $comment->user->id,
                'updated_at' => $updated_at,
                'content' => $comment->content,
            ];
            array_push($return, $newComment);
        }
        return $return;
    }

    public function replyPost(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ],[
            'content.required' => '請填寫回覆內容'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response('create');
    }

    public function replyDelete($id)
    {
        if ($comment = Comment::findOrFail($id)){
            $comment->delete();
            return response('刪除成功');
        }
        else {
            return response('找不到此留言');
        }
    }
}
