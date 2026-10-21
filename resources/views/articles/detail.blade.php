@extends('welcome')

@php
    use Carbon\carbon;
 @endphp
@section('content')

    <main class="container">
        <section class="row">
            <div class="col-lg-8">
                <img src="{{asset("storage/imageArticle/".$article->imageArticle)}}" class="w-100" height="250" alt="">
                <p>
                    {{$article->descArticle}}
                </p>
                <p>
                   Titre: {{$article->nomArticle}}
                </p>
                <p>
                    Auteur: {{$article->user->name}}
                </p>
                <p>
                    publie le:
                    @php
                        $dt= Carbon::parse($article->created_at)->locale('fr_FR');
                        echo $dt->isoFormat("LLLL")
                     @endphp
                </p>
            </div>
            <div class="col-lg-4">
                <form action="{{route('article.comment',['id'=>$article->id])}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Votre commentaire...">{{old('comment')}}</textarea>
                        @error('comment')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Envoyez</button>
                </form>
                @forelse($commentaires as $commentaire)
                    <div class="border border-primary p-2 my-2">
                        <p class="text-wrap">Nom: {{$commentaire->user->name}}</p>
                        <p>{{$commentaire->comment}}</p>
                    </div>
                @empty
                    <p>Pas de commentaires</p>
                @endforelse
            </div>
        </section>
    </main>
@endsection
