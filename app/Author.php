<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {


    /**
     * Main attributes of an Author
     */
    protected $fillable = [
        'id', 'name', 'email'
    ];

    /**
     * Attributes wich will not be in the JSON object
     */

     protected $hidden = [];

}