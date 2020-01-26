<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller {

    public function showAllRates(){
        return response()->json(Rate::all());
    }

    public function showRate($id){
        return response()->json(Rate::findOrFail($id));
    }

    public function create(Request $request){
        $rate = Rate::create($request->all());
        var_dump($rate->rate);
        return response()->json($rate, 201);
    }

    public function update($id, Request $request){
        $rate = Rate::findOrFail($id);
        $rate->update($request->all());

        return response()->json($rate, 200);
    }

    public function delete($id){
        Rate::findOrFail($id)->delete();
        return response('Rate removed successfuly !', 200);
    }

}
