<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
        ->select('users.name','posts.*')
        ->join('users','users.id','=','posts.user_id')
        ->orderBy('id', 'desc')
        ->get();
        //To get the records using sql statement
        //$posts = DB::select('SELECT * FROM posts order by id desc');
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
         'title' => 'required',
         'body' => 'required',
         'cover_image' => 'image|nullable|max:1999'
     ]);
     //handle file upload
     if($request->hasFile('cover_image')){
       //get filename with extensions
       $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
       //get just the fileName
       $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
       //get just the extension
       $extension = $request->file('cover_image')->getClientOriginalExtension();
       //filename to Store
       $fileNameToStore = $filename.'_'.time().'_'.$extension;
       //upload file
       $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
     }else{
       $fileNameToStore = 'noImage.jpg';
     }
     $post = new Post;
     $post->title = $request->input('title');
     $post->body = $request->input('body');
     $post->user_id = auth()->user()->id;
     $post->cover_image = $fileNameToStore;
     $post->save();
     return redirect('/posts')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $post['name'] = User::find($post->user_id)->name;
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      if(auth()->user()->id !== $post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
      }
      return view('posts.edit')->with('post', $post);
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
      $this->validate($request, [
         'title' => 'required',
         'body' => 'required',
         'cover_image' => 'image|nullable|max:1999'
     ]);
     //handle file upload
     if($request->hasFile('cover_image')){
       //get filename with extensions
       $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
       //get just the fileName
       $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
       //get just the extension
       $extension = $request->file('cover_image')->getClientOriginalExtension();
       //filename to Store
       $fileNameToStore = $filename.'_'.time().'_'.$extension;
       //upload file
       $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
     }
     $post = Post::find($id);
     $post->title = $request->input('title');
     $post->body = $request->input('body');
     if($request->file('cover_image')){
       $post->cover_image = $fileNameToStore;
     }
     $post->save();
     return redirect('/posts')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      if(auth()->user()->id !== $post->user_id){
          return redirect('/posts')->with('error', 'Unauthorized Page');
      }
      if($post->cover_image !== 'noImage.jpg'){
        Storage::delete('public/cover_images'.$post->cover_image);
      }
      $post->delete();
      return redirect('/home')->with('success', 'Post deleted successfully');
    }
}
