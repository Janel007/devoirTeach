@extends('welcome')

@section('content')

    <main class="container mt-3">

        <section class="row d-flex justify-content-center">

            <div class="col-lg-7">

                <p class="display-6 text-center">S'inscrire</p>

                <form method="post" action="{{route('register')}}">

                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">User name</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="{{old('nom')}}">
                        @error('nom')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

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

                    <div class="mb-3">
                        <label for=" password" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="password" name="password_confirmation" value="{{old('password')}}">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <p class="text-center my-3">
                        Deja un compte? <a href="{{route('login')}}">Se connecter</a>
                    </p>
                    <button type="submit" class="w-100 btn btn-dark">S'inscrire</button>
                </form>
            </div>
        </section>
    </main>
@endsection
