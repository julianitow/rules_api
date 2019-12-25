<?php

namespace App\Http\Controllers;

use App\Rule;
use App\Author;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller {

    public function showAllRules(){

        $rules = Rule::get();

        foreach($rules as $rule){
            $author = Author::find($rule->author);
            $category = Category::find($rule->category);
            
            $rule->author = $author->toArray();
            $rule->category = $category->toArray();
        }
        
        return $rules->toJson();
    }

    public function create(Request $request){
        $rule = Rule::create($request->all());
        return response()->json($rule, 201);
    }

    public function update($id, Request $request){
        $rule = Rule::findOrFail($id);
        $rule->update($request->all());
        return response()->json($rule, 200);
    }

    public function delete($id){
        Rule::findOrFail($id)->delete();
        return response('Rule removed successfuly !', 200);
    }
}