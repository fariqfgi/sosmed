@extends('layouts.app')

@section('content')
<div class="container bg-white pb-5">
    <div class="row d-flex justify-content-start align-items-center mt-sm-5">
        <div class="col-lg-5 col-10">
            <div class="pb-5"> <img src="https://img.freepik.com/free-vector/authentication-concept-illustration_114360-2168.jpg?size=338&ext=jpg&ga=GA1.2.777073396.1599399655" alt=""> </div>
        </div>
        <div class="col-lg-4 offset-lg-2 col-md-6 offset-md-3">
            <div class="mt-3 mt-md-5">
                <h5 class="text-center">Log in to your account</h5>
                <form action="{{ route('login') }}" method="POST" class="pt-4">
                    @csrf

                    <div class="d-flex flex-column pb-3">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input type="email" name="email" id="email" class="border-bottom border-primary form-control @error('email') is-invalid @enderror" required> 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="d-flex flex-column pb-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" name="password" id="password" class="border-bottom border-primary form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-custom btn-block mt-3 mb-3" >
                        {{ __('Login') }}
                    </button>
                </form>
                <div class="text-center mt-5">
                    <p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
