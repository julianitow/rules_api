<?php

namespace App\Http\Controllers;

use App\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller {

    public function showAllRules(){
        return response()->json(Rule::all());
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

    /*
    public function showAllCategories(){
        return response()->json(Categories::all());
    }*/

}