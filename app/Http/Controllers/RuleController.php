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
        $category = Category::create($request->category);
        $author = Author::create($request->author);
        $request->category = $category->id;
        $request->author = $author->id;
        $rule = new Rule();
        $rule->name = $request->name;
        $rule->content = $request->content;
        $rule->category = $category->id;
        $rule->author = $author->id;
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
}
