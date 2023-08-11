@extends('app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post" class=" p-2">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 row">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" placeholder="your@email.com" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-4 row">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" placeholder="Password Confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <input type="submit" class="col-md-12 btn btn-primary" value="Register">
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('login') }}" class="col-md-12 btn btn-success">Login</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-secondary mt-1">Or, Login with Google</span>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('google-auth-redirect') }}" class="col-md-12 btn btn-danger">Google</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
