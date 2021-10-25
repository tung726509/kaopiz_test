<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function add(Request $req)
    {
        if(!Auth::check()){
            return Response::json(['success'=>false,'message'=>'Cần đăng nhập để bình luận về bài viết!']);
        }

        $post_id = $req->post_id;
        $message = $req->message;
        $user_id = Auth::user()->id;

        if($message){
            $post = Post::find($post_id);
            if(!$post){
                return Response::json(['success'=>false,'message'=>'Lỗi hệ thống!']);
            }

            $new_comment = Comment::create([
                'post_id' => $post_id,
                'user_id' => $user_id,
                'content_comment' => $message,
            ]);

            if($new_comment){
                return Response::json(['success'=>true,'message'=>'Bình luận đã được gửi!','comment_id'=>$new_comment->id]);
            }else{
                return Response::json(['success'=>false,'message'=>'Lỗi hệ thống!']);
            }
        }
    }
}
