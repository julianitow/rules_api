<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller {

    public function showAllAuthors(){
        return response()->json(Author::all());
    }

    public function showAuthorById($id){
        $author = Author::findOrFail($id);
        $result = [$author->toArray()];

        return response()->json($result);
    }

    public function showAuthorByEmail($email){
        $author = Author::findOrFail($email);
        $result = [$author->toArray()];

        return response()->json($result);
    }

    public function create(Request $request){
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    public function update($id, Request $request){
        $author = Author::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id){
        Author::findOrFail($id)->delete();
        return response('Author removed successfuly !', 200);
    }

}
