@extends('pages.layout')

@section('pages')
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->has('error'))
        <div class="alert alert-danger mb-3">
            {{ $errors->first('error') }}
        </div>
    @endif

    @if($user == null)
        <div class="alert alert-danger mb-3">
            User not found!
        </div>
    @endif

    @if($user != null)
        <a href="{{ route('user-info', $user->username ) }}" class="btn btn-success mb-3">Back</a>

        @include('pages.user.sections.payment')
    @endif
@endsection


