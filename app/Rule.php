<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model {


    /**
     * Main attributes of a rule
     */
    protected $fillable = [
        'name', 'content', 'author', 'category'
    ];

    /**
     * Attributes wich will not be in the JSON object
     */

     protected $hidden = [];

}