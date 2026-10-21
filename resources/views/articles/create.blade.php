@extends('welcome')

@section('content')
    <main class="container mt-3">

        <section class="row d-flex justify-content-center">

            <h3 class="text-center">Creer un article</h3>

            <div class="col-lg-7">

                @session('Succes')
                    <div class="alert alert-success ">{{$value}}</div>
                @endsession

                <form method="post" action="{{route('article.create')}}" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <input type="nom" class="form-control" name="nom" value="{{old('nom')}}" placeholder="Entrer le nom de l'article">
                        @error('nom')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="comment" rows="3" placeholder="description article">{{old('comment')}}</textarea>
                        @error('comment')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image Article</label>
                        <input class="form-control" id="formFile" type="file" name="file" accept="image/*">
                        @error('file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Creer</button>

                </form>
            </div>

        </section>
    </main>
@endsection
