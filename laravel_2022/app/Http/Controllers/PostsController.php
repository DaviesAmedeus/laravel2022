<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class PostsController extends Controller
{
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
    return view('blog.index',[
        'posts'=>DB::table('posts')->get()
    ]); 




        // $posts= DB::table('posts')->get();
        // return view('blog.index', compact('posts')); //return a pile of array




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id =1)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
