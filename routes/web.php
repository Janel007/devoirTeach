<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    route::get('/logout',[\App\Http\Controllers\HomeController::class,'logout'])->name('logout');

    route::get('/article/create',[\App\Http\Controllers\ArticleController::class,'showFormArticle'])->name('article.create');
    route::post('/article/create',[\App\Http\Controllers\ArticleController::class,'createArticle'])->name('article.create');

    route::get('/article/detail/{id}',[\App\Http\Controllers\ArticleController::class,'detailArticle'])
        ->whereNumber('id')
        ->name('article.detail');

    route::post('/article/detail/{id}',[\App\Http\Controllers\ArticleController::class,'storeComment'])
        ->whereNumber('id')
        ->name('article.comment');
});

route::get('/',[\App\Http\Controllers\HomeController::class,'home'])->name('home');

route::get('/login',[\App\Http\Controllers\AuthController::class,'showFormLogin'])->name('login');
route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');

route::get('/register',[\App\Http\Controllers\AuthController::class,'showFormRegister'])->name('register');
route::post('/register',[\App\Http\Controllers\AuthController::class,'register'])->name('register');

Route::fallback(function () { //Cette route redirige vers la page d'accueil si aucune autre route ne correspond à l'URL demandée.
    return redirect('/');
});




