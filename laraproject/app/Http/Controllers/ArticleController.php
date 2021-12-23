<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ArticleController extends Controller
{
    public function index(){
        return view('create-article');
    }

    public function store(Request $req){
        if(Auth::user()){
            $article = new Article();
            $article->author_id=Auth::user()->id;
            $article->user=Auth::user()->name;
            $article->headline = $req->headline;
            $article->content = $req->content;
            $article->save();
            return redirect('create-article')->with('status','successfully added');
        }
    }

    public function loadStart(){
        $articles = Article::orderBy('created_at', 'DESC')->paginate(5);
        return view('welcome', ['articles'=>$articles]);
    }

    public function loadPage($id){
        $article = Article::findOrFail($id);
        return view('article', ['article'=>$article]);
    }

    public function editPage($id){
        $article = Article::findOrFail($id);
        if(Auth::user() && Auth::user()->id==$article->author_id){
            return view('editarticle', ['article'=>$article]);
        }
        abort(403);
    }

    public function updateArticle(Request $req){
        if(Auth::user()){
            $article = Article::findOrFail($req->id);
            if($article->author_id==Auth::user()->id){
                $article->headline=$req->headline;
                $article->content=$req->content;
                $article->save();
            }
            return redirect('edit-article/' . $article->id)->with('status', 'successfully updated');
        }
        abort(403);
    }

    public function deletePage($id){
        $article = Article::findOrFail($id);
        if(Auth::user() && Auth::user()->id==$article->author_id){
            return view('delete-article', ['article'=>$article]);
        }
        abort(403);
    }

    public function delete($id){
        $article = Article::findOrFail($id);
        if(Auth::user() && Auth::user()->id==$article->author_id){
            $article->delete();
            return redirect('/');
        }
        abort(403);
    }

    public function searchPage(){
        return view('search');
    }

    public function search(Request $req){
        $res = $req['search'];
        $query = Article::where('user', 'like', "%" . $res . "%")
                          ->orWhere('headline', 'like', "%" . $res . "%");
        
        if(!$query->first()){
            return view ('emptysearch');
        }

        $articles = $query->orderBy('created_at', 'DESC')->paginate(5);
        return view('welcome', ['articles'=>$articles]);
    }
}
