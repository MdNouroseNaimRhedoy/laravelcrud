<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view('create');
    }

    public function filestore(Request $request){
        //model initiate kora lagbe
        $post = new Post;

        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $request->image;

        $post->save();
        
        #return redirect()->back();
        return redirect()->route('home')->with("success", "Your Post has been added.");
    }
}
