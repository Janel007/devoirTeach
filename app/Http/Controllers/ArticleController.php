<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class ArticleController extends Controller
{
    public function showFormArticle(){
        return view('articles.create');
    }



    public function createArticle(Request $request) {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'comment' => 'required|min:20',
            'file' => [
                'required',
                File::image()
                    ->min('1kb')
                    ->max('2mb'),
            ],

        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('article.create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();

            $request->file('file')->storeAs(
                'imageArticle',
                $name,
                'public'
            );

            Article::create([
                'nomArticle'=>$request->nom,
                'imageArticle'=>$name,
                'descArticle'=>$request->comment,
                'user_id'=>Auth::user()->id,
            ]);
            return back()->with('Succes','Votre article a ete cree');
        }
    }



    public function detailArticle(string $id) { //Cette ligne recherche un article dans la base de données en utilisant l'$id fourni. findOrFail() est une méthode de Laravel qui retourne l'article s'il existe, ou lance une exception 404 (Not Found) si l'article n'est pas trouvé.
        $article=Article::findOrFail($id);
        $commentaires=Commentaire::where('article_id','=',$id)->get(); //Cette ligne récupère tous les commentaires associés à l'article. where('article_id', '=', $id) filtre les commentaires pour ne sélectionner que ceux qui correspondent à l'ID de l'article.
        //get() exécute la requête et retourne une collection de tous les commentaires correspondants.
        return view('articles.detail',compact('article','commentaires'));
        //compact('article', 'commentaires') est une façon de passer des variables à la vue. C'est équivalent à ['article' => $article, 'commentaires' => $commentaires].
    }



    public function storeComment( string $id, Request $request){
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:20',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back() //Si la validation échoue, l'utilisateur est redirigé vers la page précédente avec les erreurs et les données saisies.
                ->withErrors($validator)
                ->withInput();
        }else{
            Commentaire::create([ //Si la validation réussit, un nouveau commentaire est créé dans la base de données.
                'comment'=>$request->comment,
                'user_id'=>Auth::user()->id, //Le commentaire est associé à l'utilisateur actuellement authentifié et à l'article spécifié.
                'article_id'=>$id,
            ]);
            return back()->with('succes','Votre commentaires a ete envoye');
        }
    }
}
