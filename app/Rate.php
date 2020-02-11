<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {


    /**
     * Main attributes of an Rate
     */
    protected $fillable = [
        'rate', 'rule'
    ];

    /**
     * Attributes wich will not be in the JSON object
     */

    protected $hidden = [];

}
