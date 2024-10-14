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

        //Validation 
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,png,JPEG,jpg,JPG,HEIF,heic,HEIC'
        ]);

        //Image Uploading
        $imageName = null;
        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();
            //store image in public folder local
            $request->image->move(public_path('images'),$imageName);
        }
        

        //model initiate kora lagbe
        $post = new Post;

        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $imageName ;

        $post->save();
        
        #return redirect()->back();
        return redirect()->route('home')->with("success", "Your Post has been added.");
    }

    public function editData($id){
        $post = Post::findOrFail($id);
        return view('edit',['ourPost'=> $post]);
    }

    public function updateData(Request $request,$id){
        //Validation for updating
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,png,JPEG,jpg,JPG'
        ]);

        
        //Id  Catch korlam
        $post = Post::findOrFail($id);

        $post->name = $request->name;
        $post->description = $request->description;
        //Image Update if img found in database 
        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();
            $post->image = $imageName ;
            //store image in public folder local
            $request->image->move(public_path('images'),$imageName);
        }

        $post->save();
        
        #return redirect()->back();
        return redirect()->route('home')->with("success", "Your Post has been Updated.");
    
    }


    public function deleteData($id){
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->route('home')->with("success", "Your Post has been Deleted.");
    

    }
}
