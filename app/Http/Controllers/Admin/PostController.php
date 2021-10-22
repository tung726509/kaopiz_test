<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $header = 'Tổng hợp tất cả bài post';
        $model = new Post();
        $posts = $model->all();

        // dd($model->all());

        return view('post.index',compact('header','posts'));
    }

    public function detail($id)
    {
        $post = Post::with(['user'])->find($id);
        $header = 'Chi tiết';

        return view('post.detail',compact('post','header'));
    }

    public function getAdd(Type $var = null)
    {
        $header = 'Thêm mới bài viết';
        // dd(Auth::user());

        return view('post.add',compact('header'));
    }

    public function add(Request $req)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $title = $req->input('title');
        $content = $req->input('content');
        $user_id = Auth::user()->id;

        $model = new Post();
        $model->title = $title;
        $model->content = $content;
        $model->user_id = $user_id;
        if($model->save()){
            return back()->with('success','Thành công!');
        }else{
            return back()->with('fail','Vui lòng thử lại sau!');
        }
    }

    public function getEdit($id)
    {
        $header = 'Chỉnh sửa bài viết';
        $post = Post::with(['user'])->find($id);

        return view('post.edit',compact('header','post'));
    }

    public function edit(Request $req,$id)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $title = $req->input('title');
        $content = $req->input('content');

        $post = Post::find($id);
        $post->title = $title;
        $post->content = $content;
        if($post->save()){
            return back()->with('success','Thành công!');
        }else{
            return back()->with('fail','Vui lòng thử lại sau!');
        }
    }

    public function delete(Request $req)
    {
        $del = Post::where('id',$req->id)->delete();

        if($del){
            return Response::json(['success'=>true,'message'=>'Xóa thành công!']);
        }else{
            return Response::json(['success'=>false,'message'=>'Lỗi hệ thống, vui lòng thử lại sau!']);
        }
        // return Response::json(['success'=>true,'message'=>'Xóa thành công!']);
    }
}
