<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Like;
use App\Dislike;
use App\Comment;
use App\Profile;
use Auth;
use File;
use URL;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Category::all();
        return  view('posts.post', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->input('post_title');
        $request->validate([
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required'
        ]);
        $posts = new Post;
        $posts->post_title = $request->post_title;
        $posts->user_id = Auth::user()->id;   //current user logddin
        $posts->post_body = $request->post_body;
        $posts->category_id = $request->category_id;

        if (Input::hasFile('post_image')) {
            $file = Input::file('post_image');
            $file->move(public_path().'/posts/', $file->getClientOriginalName());
            $url= URL::to("/"). '/posts/'.$file->getClientOriginalName();
            // return $url;
            // exit();
        }
        // $profiles->post_image = $request->post_image;
        // $profiles->user_id = Auth::user();

        $posts->post_image = $url;
        $posts ->save();
        return redirect('/home')->with('message','Posts added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        //  return $id;
        //  exit();
        $posts = Post::where(['id'=>$id])->get();
        $likePost = Post::find($id);
        $likeCtr = Like::where(['id'=> $likePost->id])->count();
        // return $likeCtr;
        // exit();
        $dislikeCtr = Dislike::where(['id'=> $likePost->id])->count();
        // return $likeCtr;
        // exit();
        $categories = Category::all();
        //user and Comment table is join
        $comments = DB::table('users')
                -> join ('comments', 'users.id','=', 'comments.user_id')
                -> join ('posts', 'comments.post_id','=','posts.id')
                -> select('users.name','comments.*')
                -> where(['posts.id'=>$id])
                -> get();
        // return $comments;
        // exit();
        return view('posts.view', ['posts'=>$posts, 'categories'=>$categories,
         'likeCtr'=>$likeCtr, 'dislikeCtr'=>$dislikeCtr, 'comments'=> $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $id)
    {
        $categories = Category::all();
        $posts = Post::find($id)->first();
        $category = Category::find($posts->category_id);
        return view('posts.edit',['categories'=> $categories,'posts'=>$posts,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $request->validate([
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required'
        ]);
        $posts = new Post;
        $posts->post_title = $request->post_title;
        $posts->user_id = Auth::user()->id;   //current user logddin
        $posts->post_body = $request->post_body;
        $posts->category_id = $request->category_id;

        if (Input::hasFile('post_image')) {
            $file = Input::file('post_image');
            $file->move(public_path().'/posts/', $file->getClientOriginalName());
            $url= URL::to("/"). '/posts/'.$file->getClientOriginalName();

        }

        $posts->post_image = $url;

        $data = array(
            'post_title'=> $posts->post_title,
            'user_id'=> $posts->user_id,
            'post_body'=> $posts->post_body,
            'category_id'=> $posts->category_id,
            'post_image'=> $posts->post_image,
        );
        Post::where(['id'=>$id])->update($data);
        // $posts->update();
        $posts ->update();
        return redirect('/home')->with('message','Posts updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        // return $id;
        Post::Where(['id'=>$id])->delete();
        return redirect('/home')->with('message','Posts Deleted successfully');
    }

    public function category($id){
        //  return $id;
        $categories = Category::all();
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*',  'categories.*')
            ->where(['categories.id'=>$id])
            ->get();
        return view('categories.categoryPost',['categories'=>$categories, 'posts'=>$posts]);
    }

    public function like($id){
        // return $id;
        // exit();
        $loggedin_user = Auth::user()->id;
        $like_user = Like::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if (empty($like_user->user_id)) {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;

            $like = new Like;
            $like-> user_id = $user_id;
            $like-> email = $email;
            $like-> post_id = $post_id;
            $like->save();

            return redirect('/view/{id}');
        }else{
            return redirect('/view/{id}');
        }

    }

    public function dislike($id){
        // return $id;
        // exit();
        $loggedin_user = Auth::user()->id;
        $like_user = Dislike::where(['user_id' => $loggedin_user, 'post_id' => $id])->first();
        if (empty($like_user->user_id)) {
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;

            $like = new Dislike;
            $like-> user_id = $user_id;
            $like-> email = $email;
            $like-> post_id = $post_id;
            $like->save();

            return redirect('/view/{id}');
        }else{
            return redirect('/view/{id}');
        }

    }
    public function comment(Request $request, $id){
        // return $id;
        $this -> validate($request,[
            'comment'=>'required',
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect('/view/{id}')->with('message','comment Added Successfully');
    }

    public function search(Request $request){
        // return $request ->input('search');
        $user_id = Auth::user()->id;
        $profile = Profile::find($user_id );
        $keyword = $request-> search;
        $posts = Post::where('post_title', 'LIKE', '%'.$keyword.'%')->get();
        return view('posts.searchPosts',['profile'=>$profile,'posts'=>$posts]);

    }
}
