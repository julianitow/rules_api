<?php

namespace App\Http\Controllers;

use App\Rule;
use App\Author;
use App\Category;
use App\Rate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller {

    public function showAllRulesExpanded(){

        $rules = Rule::get();

        foreach($rules as $rule){
            $author = Author::findOrFail($rule->author);
            $category = Category::findOrFail($rule->category);

            $rates = DB::select('SELECT * FROM rates where rule=' . $rule->id);
            $nbRate = 0;
            $totalRate = 0;
            foreach($rates as $rate){
                $nbRate++;
                $totalRate += $rate->rate;
            }
            if($rates==NULL){
                $finalRate = 0;
            }
            else {
                $finalRate = $totalRate / $nbRate;
            }

            $rule->author = $author->toArray();
            $rule->category = $category->toArray();
            $rule->rate = $finalRate;
        }

        return $rules->toJson();
    }

    public function showAllRules(){

        $rules = Rule::get();

        foreach($rules as $rule){
            $author = Author::findOrFail($rule->author);
            $category = Category::findOrFail($rule->category);

            $rates = DB::select('SELECT * FROM rates where rule=' . $rule->id);
            $nbRate = 0;
            $totalRate = 0;
            foreach($rates as $rate){
                $nbRate++;
                $totalRate += $rate->rate;
            }
            if($rates==NULL){
                $finalRate = 0;
            }
            else {
                $finalRate = $totalRate / $nbRate;
            }
            $rule->rate = $finalRate;
        }

        return $rules->toJson();
    }

    public function showRuleById($id){
        $rule = Rule::findOrFail($id);
        $author = Author::findOrFail($rule->author);
        $category = Category::findOrFail($rule->category);

        $rates = DB::select('SELECT * FROM rates where rule=' . $id);
        $nbRate = 0;
        $totalRate = 0;
        foreach($rates as $rate){
            $nbRate++;
            $totalRate += $rate->rate;
        }
        if($rates==NULL){
            $finalRate = 0;
        }
        else {
            $finalRate = $totalRate / $nbRate;
        }

        $rule->author = $author->toArray();
        $rule->category = $category->toArray();
        $rule->rate = $finalRate;

        return $rule->toJson();
    }

    public function create(Request $request){
        $author = null;
        $category = null;
        $rule = new Rule();
        $rule->name = $request->name;
        $rule->content = $request->content;
        $rule->drinks = $request->drinks;
        /*$tmp_rule = Category::findOrFail($request->category);
        
        if($tmp_rule == null){
            if(!is_int($request->category)){
                Category::create($tmp_rule->toArray());
            }
        } else {

        }*/

        if(is_int($request->category)){
            $rule->category = $request->category;
        } else {
            $category = Category::create($request->category);
            $rule->category = $category->id;
            $request->category = $category->id;
        }
        if(is_int($request->author)){
            $rule->author = $request->author;
        } else {
            $author = Author::create($request->author);
            $rule->author = $author->id;
            $request->author = $author->id;
        }

        $result = Rule::create($rule->toArray());

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

    public function getByCategory($name){
        $category = DB::select('SELECT * FROM categories WHERE name LIKE \'' . $name . '\'')[0];
        $rules = DB::select('SELECT * FROM rules WHERE category = ' . $category->id);
        $result = [];
        foreach($rules as $rule){
            array_push($result, $rule);
        }
        return response()->json($result, 200);
    }
}
