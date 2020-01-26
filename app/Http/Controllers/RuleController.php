<?php

namespace App\Http\Controllers;

use App\Rule;
use App\Author;
use App\Category;
use App\Rate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller {

    public function showAllRules(){

        $rules = Rule::get();

        foreach($rules as $rule){
            $author = Author::findOrFail($rule->author);
            $category = Category::findOrFail($rule->category);
            $rates = Rate::where('idRule', $rule->id)->take(10)->get();

            $rule->author = $author->toArray();
            $rule->category = $category->toArray();
            $nbRates = 0;
            foreach($rates as $rate){
                var_dump($rate->rate);
                $nbRates++;
                $rate /= $nbRates;
                $rule->rate = $rate;
            }
        }
        
        return $rules->toJson();
    }

    public function showRuleById($id){
        $rule = Rule::findOrFail($id);
        $author = Author::findOrFail($rule->author);
        $category = Category::findOrFail($rule->category);

        $rule->author = $author->toArray();
        $rule->category = $category->toArray();

        return $rule->toJson();
    }

    public function create(Request $request){
        $rule = Rule::create($request->all());
        var_dump($request); 
        $rate = 0;
        $rule->rate = $rate;
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