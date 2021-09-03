<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class BookController extends Controller
{

    public function createBook(Request $request){

        $request->validate([

            "title" => "required",
            "description" => "required",
            "book_cost" => "required",
            "image" => "image|mimes:jpg,png,jpeg,gif,svg"

        ]);

        $book = new Book;

        $book->author_id = auth()->user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->book_cost = $request->book_cost;
        if($request->hasFile('image')){
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ','_', $fileNameOnly).'-'.rand() . '_'.time(). '.'.$extension;
            
            $path = $request->file('image')->storeAs('public/posts', $compPic);
            $book->image = $compPic;
        }
            if($book->save()){
                return ["status" => true, "message" => "Book is created Successfully"];
            }else{
                return ["status" => false, "message" => "Something Went Wrong"];
            }
        
    }

    public function displayBooks(Request $request){

    }

}
