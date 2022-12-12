<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostFormRequest;
 
class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    /*
    |--------------------------------------------------------------------------
    | QUERY BUILDER -simple
    |--------------------------------------------------------------------------
    | NB: The ?(question marks) or :variableName -are used as prepared parameters in sql statements

    */
        
      
        // $posts = DB::statement('select * FROM posts'); 

        /*SELECT statement*/
        // $posts = DB::select('SELECT * FROM posts WHERE id = :id', ['id'=> 1]); //select statements
        
        /*INSERT statement*/
        // $posts = DB::insert("INSERT INTO posts (title, excerpt, body, image_path, is_published, min_to_read) VALUES (?, ?, ?, ?, ?, ?)", ['test', 'test', 'test', 'test', true, 1 ]); 

        /*UPDATE statement*/
        // $posts = DB::update('UPDATE posts SET body = ? WHERE id = ?', [ 'Body AAAAAA', '201' ]);

        /*DELETE statement*/
        // $posts = DB::delete('DELETE FROM posts WHERE id = :id', ['id'=> 201]);


    /*
    |--------------------------------------------------------------------------
    | QUERY BUILDER - with chaining method (complex)
    |--------------------------------------------------------------------------
    | NB: the get() should always be at the end of the chain
    */

        // $posts = DB::table('posts')->select('title', 'body')->get();

        // --------- where() method -------------
        // $posts = DB::table('posts')->where('is_published', true)->get();
        // $posts = DB::table('posts')->whereBetween('min_to_read', [2, 6])->get();
        // $posts = DB::table('posts')->whereNotBetween('min_to_read', [2, 6])->get();
        // $posts = DB::table('posts')->whereNull('excerpt')->get();
        // $posts = DB::table('posts')->whereNotNull('excerpt')->get();

    // --------- -------------
    // $posts = DB::table('posts')->select('min_to tread')->distinct()->get();
    // $posts = DB::table('posts')->orderBy('id', 'desc')->get();
    // $posts = DB::table('posts')->skip(30)->take(10)->get();
    // $posts = DB::table('posts')->inRandomOrder()->get();

    // --------- -------------
    // $posts = DB::table('posts')->orderBy('id', 'desc')->first();
    // $posts = DB::table('posts')->find(100); //finds based on a primary key
    // $posts = DB::table('posts')->where('id', 100)->value('body'); //Display the value of the field
    // $posts = DB::table('posts')->where('id', '<', 20)->count();

    // --------- -------------
    // $posts = DB::table('posts')->min('min_to_read');
    // $posts = DB::table('posts')->max('min_to_read');
    // $posts = DB::table('posts')->sum('min_to_read');
    // $posts = DB::table('posts')->avg('min_to_read');

        // dd($posts);

        
         /*
    |--------------------------------------------------------------------------
    | VARIABLES & CONTROL STRUCTURES
    |--------------------------------------------------------------------------
    */
        // $posts= DB::table('posts')->find(1);
        // return view('blog.index')->with('posts', $posts);  //OR
    /*return view('blog.index',[
        'posts'=>DB::table('posts')->get()
    ]); */

        // $posts= DB::table('posts')->get();
        // return view('blog.index', compact('posts')); //return a pile of array


    /*
    |--------------------------------------------------------------------------
    |RETRIEVIG DATA USING ELOQUENT
    |--------------------------------------------------------------------------
    */

    /*
    //all() does not support method chaining while get() supports method chaining
    $posts = Post::all();
    $posts = Post::get();
    */

    // $posts = Post::orderBy('id', 'desc')->take(10)->get();
    // $posts = Post::where('min_to_read', 2)->take(10)->get();

    /*Post::chunk(25, function($posts){
        foreach($posts as $post){
            echo $post->title.'<br>';
        }
    });
 */
/* ------------Aggregate functions--------*/
//  $posts = Post::get()->count();
//  $posts = Post::get()->sum('min_to_read');
//  $posts = Post::get()->avg('min_to_read');


/* ------------sending to the blade--------*/


    return view('blog.index', [
        'posts'=> Post::orderBy('updated_at', 'desc')->paginate(10),
        
    ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //returns a form to that data is inserted
        return view('blog.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {   
        /* -----OLDWAY OF OOP ----*/
        // $post = new Post();
        // $post->title = $request->title;
        // $post->excerpt = $request->excerpt;
        // $post->body = $request->body;
        // $post->image_path = 'temporary';
        // $post->is_published = $request->is_published === 'on'; 
        // $post->min_to_read = $request->min_to_read;
        // $post->save();

        /* -----form valiation (Which can be optional but for security and consistence it is better----*/
        
        
        // 1. -----Validation without formRequest----------
       /* $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',

        ]);

        */

        // 2. -----Validation withformRequest----------
        $request->validated();
        /* -----ELOQUENT WAY OF INSERTING DATA ----*/
        $post = Post::create([
            'user_id'=> Auth::id(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $this->storeImage($request),
            'is_published' => $request->is_published === 'on',
            'min_to_read' => $request->min_to_read,
        ]);

        $post->meta()->create([
            'post_id'=> $post->id,
            'meta_description'=> $request->meta_description,
            'meta_keywords'=> $request->meta_keywords,
            'meta_robots'=> $request->meta_robots,

        ]);

        return redirect(route('blog.index'));
       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* ------------
        find() v/s  findOrFail()
        find() returns null if the parameter route is not available
        findOrFail() returns 404 page (good one!)

        --------*/
        // $post = Post::find($id);
        // $post = Post::findOrFail($id);

        return view('blog.show',[
            'post'=> Post::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('blog.edit', [
        'post'=> Post::where('id',  $id)->first()
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        /*
        $request->validate([
            'title' => 'required|max:255|unique:posts,id',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => ['mimes:png,jpg,jpeg', 'max:5048'],
            'min_to_read' => 'min:0|max:60',

        ]);
        */

        $request->validated();
       

       Post::where('id', $id)->update($request->except([
        '_token', '_method',
    ]));

   

       return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect(route('blog.index'))->with('message', 'Post has been deleted');
    }

    //storing of image
    private function storeImage($request)
    {
        //    forming the new image name
            $newImageName = uniqid().$request->title.'.'.$request->image->extension();

            return $request->image->move(public_path('images', $newImageName));
    }
}
