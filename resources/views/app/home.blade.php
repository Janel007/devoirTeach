@extends('welcome')

@php 
    use Carbon\Carbon; 
@endphp 

<!--php précédé de @ est une directive Blade qui permet d'écrire du code PHP brut dans une vue. Tout ce qui se trouve entre php et endphp sera exécuté comme du PHP standard.
Cette instruction use importe la classe Carbon du namespace Carbon.
Carbon est une extension populaire de la classe DateTime de PHP, qui offre de nombreuses fonctionnalités utiles pour la manipulation et le formatage des dates et des heures.
-->

@section('content')
    <main class="container mt-3">
        <section>
            <h3 class="text-center">Tous les articles</h3>

            @forelse($articles as $article)
                <div class="col-12">
                    <a href="{{route('article.detail',['id'=>$article->id])}}" style="text-decoration: none">
                        <div class="card mb-3" >
                            <img src="{{asset('storage/imageArticle/'.$article->imageArticle)}}" class="w-100" style="object-fit: cover" height="300" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$article->nomArticle}}</h5>
                                <p class="card-text">{{Str::limit($article->descArticle,20)}}</p>
                                <p>
                                    Auteur: <strong>{{$article->user->name}}</strong> <br>
                                    Date de creation:
                                    <strong>
                                        @php
                                            $dt = Carbon::parse($article->created_at);
                                            echo $dt->format('l jS \\of F Y h:i:s A');
                                        @endphp
                                    </strong>
                                    <!-- Autre utilisation de Carbon
                                    {{ Carbon::now()->format('d/m/Y') }} 
                                    Cela afficherait la date actuelle au format jour/mois/année.
                                    -->

                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="display-6">Pas d'article</p>
            @endforelse
        </section>
    </main>
@endsection
