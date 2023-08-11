@extends('app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            @if($errors->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('authenticate') }}" method="post" class=" p-2">
                        @csrf
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
                            <div class="col-md-6">
                                <input type="submit" class="col-md-12 btn btn-primary" value="Login">
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('register') }}" class="col-md-12 btn btn-success">Register</a>
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
