<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'excerpt', 'body', 'image_path', 'is_published', 'min_to_read'
    ]; //prevents for inserted filled in the database to be changed.
    
    // protected $table = 'posts'; //Indicating the Model belongs to posts table
    // protected $primaryKey = 'title'; //manually defining the primary key of the table
    // protected $timestamps = false; //disabling the timestamps in the database table
    // protected $connection = 'sqlite'; //setting specific database connection of the model
    // protected $attributes = ['is_published'=> true,]; //setting defaults value of the fields */


}
