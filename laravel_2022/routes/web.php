<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use League\Flysystem\Config;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

// /*
// |--------------------------------------------------------------------------
// | BASIC ROUTES
// |--------------------------------------------------------------------------
// |
// */
//     //GET - request a resource
// Route::get('/blog', [PostsController::class, 'index']); //requesting all resources
// Route::get('/blog/{id}', [PostsController::class, 'show']); // shows  a specific resource

// //POST - create a new resource
// Route::get('/blog/create', [PostsController::class, 'create']); //you request a form first
// Route::post('/blog', [PostsController::class, 'store']); //happens after you submit the form

// //PUT or PATCH - update a  resource
// Route::get('/blog/edit/{id}', [PostsController::class, 'edit']);
// Route::patch('/blog/{id}', [PostsController::class, 'update']);

// //DELETE - destroy or remove a  resource
// Route::delete ('/blog/{id}', [PostsController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| Resource Route
|--------------------------------------------------------------------------
*/
//Route::resource('blog', PostsController::class);

/*
|--------------------------------------------------------------------------
| Route for invoke method
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class);

/*
|--------------------------------------------------------------------------
| Multiple http verbs
|--------------------------------------------------------------------------
*/
// Route::match(['GET', 'POST'], '/blog', [PostsController::class, 'index']);
// Route::any('/blog', [PostsController::class, 'index']);

/*
|--------------------------------------------------------------------------
|     view route
|--------------------------------------------------------------------------
| NB: third parameter is optional.
*/
// Route::view('/blog', 'blog.index', ['name'=> 'Code with Davies']);


/*
|--------------------------------------------------------------------------
| ROUTE WITH EXPRESSIONS (regular expressions / regexes)
| NB: uses  method chaining (->) i.e interface that chains methods  call hence less coding.  
|--------------------------------------------------------------------------
|
*/
    //GET - request a resource
    // Route::get('/blog', [PostsController::class, 'index']); //requesting all resources
    // Route::get('/blog/{id}', [PostsController::class, 'show'])->where('id', '[0-9]+'); // {id}  only numbers
    // Route::get('/blog/{name}', [PostsController::class, 'show'])->where('name', '[A-Za-z]+'); // {name}  only characters
    // Route::get('/blog/{id}/{name}', [PostsController::class, 'show'])->where([
    //     'id'=> '[0-9]+',
    //     'name'=> '[A-Za-z]+'
    // ]); // {name}  only characters

    // or
        // Route::get('/blog/{id}', [PostsController::class, 'show'])->whereNumber('id'); // {id}  only numbers
        // Route::get('/blog/{name}', [PostsController::class, 'show'])->whereAlpha('name'); // {id}  only numbers
        // Route::get('/blog/{id}/{name}', [PostsController::class, 'show'])->whereNumber('id')->WhereAlpha('name');


    
    // //POST - create a new resource
    // Route::get('/blog/create', [PostsController::class, 'create']); //you request a form first
    // Route::post('/blog', [PostsController::class, 'store']); //happens after you submit the form
    
    // //PUT or PATCH - update a  resource
    // Route::get('/blog/edit/{id}', [PostsController::class, 'edit']);
    // Route::patch('/blog/{id}', [PostsController::class, 'update']);



/*
|--------------------------------------------------------------------------
| NAMED ROUTES
|--------------------------------------------------------------------------
*/

//   //GET - request a resource
//   Route::get('/blog', [PostsController::class, 'index'])->name('blog.index');
//   Route::get('/blog/{id}', [PostsController::class, 'show'])->name('blog.show'); 
  
//   //POST - create a new resource
//   Route::get('/blog/create', [PostsController::class, 'create'])->name('blog.create'); 
//   Route::post('/blog', [PostsController::class, 'store'])->name('blog.store');
  
//   //PUT or PATCH - update a  resource
//   Route::get('/blog/edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
//   Route::patch('/blog/{id}', [PostsController::class, 'update'])->name('blog.update');
  
//   //DELETE - destroy or remove a  resource
//   Route::delete ('/blog/{id}', [PostsController::class, 'destroy'])->name('blog.desroy');
  

  /*
|--------------------------------------------------------------------------
| ROUTE prefixes
|--------------------------------------------------------------------------
*/

Route::prefix('/blog')->group(function(){
    //GET - request a resource
  Route::get('/', [PostsController::class, 'index'])->name('blog.index');
  Route::get('/{id}', [PostsController::class, 'show'])->name('blog.show'); 
  
  //POST - create a new resource
  Route::get('/create', [PostsController::class, 'create'])->name('blog.create'); 
  Route::post('/blog', [PostsController::class, 'store'])->name('blog.store');
  
  //PUT or PATCH - update a  resource
  Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
  Route::patch('/{id}', [PostsController::class, 'update'])->name('blog.update');
  
  //DELETE - destroy or remove a  resource
  Route::delete ('/{id}', [PostsController::class, 'destroy'])->name('blog.desroy');
});

  /*
|--------------------------------------------------------------------------
| FALLBACK ROUTES
| NB: for pages that dont exist.
|--------------------------------------------------------------------------
*/
Route::fallback(FallbackController::class);