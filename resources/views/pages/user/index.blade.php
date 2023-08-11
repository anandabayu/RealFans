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
        @include('pages.user.sections.info')

        <div class="row">
            <div class="col-md-7">
                @include('pages.user.sections.content')
            </div>
            <div class="col-md-5">
                @include('pages.home.sections.follow')
            </div>
        </div>
    @endif
@endsection


