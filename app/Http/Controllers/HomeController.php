<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        $articles=Article::orderBy('id','desc')->get();
        return view('app.home',compact('articles'));
    }



    public function logout(Request $request){
        Auth::logout(); //Cette ligne déconnecte l'utilisateur actuellement authentifié en utilisant le système d'authentification de Laravel.
        $request->session()->invalidate(); //Cette ligne invalide la session de l'utilisateur, ce qui signifie que toutes les informations de session liées à cet utilisateur seront supprimées.
        $request->session()->regenerateToken(); //Cette ligne régénère le jeton de session de l'utilisateur. Cela empêche les attaques de type "Cross-Site Request Forgery" (CSRF) après la déconnexion.
        return redirect('/'); //Cette ligne redirige l'utilisateur vers la page d'accueil (représentée par l'URL /).
    }
}
