<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {


    /**
     * Main attributes of a rule
     */
    protected $fillable = [
        'name'
    ];

    /** 
     * Attributes wich will not be in the JSON object
     */

     protected $hidden = [];

}