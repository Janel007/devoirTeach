<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('auth.login');
    }



    public function showFormRegister()
    {
        return view('auth.register');
    }



    public function register(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('register')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                User::create([
                    'name'=>$request->nom, //En d'autres termes, ça signifie prends la valeur de l'input "nom" et tu l'attribues au champs "name" dans la base de données. 
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                ]);
                return redirect()->route('login');
            }
        }
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([ //Cette partie valide les données envoyées par l'utilisateur dans le formulaire de connexion. Les règles de validation définies ici garantissent que l'email est valide et que le mot de passe est renseigné.
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) { //Cette partie valide les données envoyées par l'utilisateur dans le formulaire de connexion. Les règles de validation définies ici garantissent que l'email est valide et que le mot de passe est renseigné. 
            //Si la connexion réussit, le code continue à l'étape suivante.
            $request->session()->regenerate(); //Cette ligne régénère la session de l'utilisateur après une connexion réussie. Cela empêche les attaques de type "Session Fixation".
            return redirect()->route('home'); //Cette ligne redirige l'utilisateur vers la route nommée "home" après une connexion réussie.
        }
        return back()->withErrors([ //Si la connexion échoue, cette partie renvoie l'utilisateur à la page de connexion avec une erreur indiquant que l'identifiant est incorrect.
            'email' => 'Identifiant incorrect.',
        ])->onlyInput('email'); //L'appel à onlyInput('email') garantit que seul le champ d'email sera réaffichée sur le formulaire, évitant ainsi de réafficher le mot de passe.
    }
}
