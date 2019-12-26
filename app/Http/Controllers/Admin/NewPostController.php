<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NewPostController extends Controller
{
    function index(){
        $posts = Posts::all();
        $count = 0;
        foreach ($posts as $post)
        {
            $count = $count + 1;
        }
        return view("admin.posts.index",['posts'=>$posts,'count'=>$count]);
    }
    function create(){
        return view("admin.posts.createposts");
    }
    public function created(Request $request){
        $post = new Posts();
        $post->author_id = Auth::id();
        $post->category_id = null;
        $post->title = $request->namepages;
        $post->anons = $request->anonspages;
        $post->body = $request->post_body;

        $avatar = $request->file('imagepost');
        $imgpath = public_path() . '/img/posts';
        File::makeDirectory($imgpath, $mode = 0777, true, true);
        if ($avatar) {
            $ext1 = $avatar->getClientOriginalExtension();
            $filename1 = uniqid('post_') . '.' . $ext1;
            $post->image = $filename1;
            $avatar->move($imgpath, $filename1);
        }

        $post->slug = $request->slugpages;
        $post->meta_description = $request->seodescriptiongoods;
        $post->meta_keywords = $request->seokeywordgoods;
        $post->status = $request->statusgoods;
        $post->created_at = Carbon::now();
        $post->updated_at = Carbon::now();
        $post->save();
        return redirect('/admin/posts');
    }
    public function editPost($slug){
        $post = Posts::where('slug',$slug)->first();
        return view('admin.posts.editPost',['post'=>$post]);
    }
}
