<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(){
        return view('create-article');
    }

    public function store(Request $req){
        Auth::user();
        $article = new Article();
        $article->author_id=Auth::user()->id;
        $article->headline = $req->headline;
        $article->content = $req->content;
        $article->save();
        return redirect('create-article')->with('status','successfully added');

        //     $table->uuid('id')->primary();
        //     $table->uuid('author_id');
        //     $table->string('headline');
        //     $table->text('content');
        //     $table->timestamps();

        //     $table->index('id');
        //     $table->index('author_id');
    }
}
