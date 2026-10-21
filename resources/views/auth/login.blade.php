@extends('welcome')

@section('content')

    <main class="container mt-3">

        <section class="row d-flex justify-content-center">

            <div class="col-lg-7">

                <p class="display-6 text-center">Se connecter</p>

                <form method="post" action="{{route('login')}}">

                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <p class="text-center my-3">
                        Pas de compte? <a href="{{route('register')}}">S'inscrire</a>
                    </p>
                    <button type="submit" class="w-100 btn btn-dark">Se connecter</button>
                </form>
            </div>
        </section>
    </main>
@endsection
