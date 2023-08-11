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

    <div class="row">
        <div class="col-md-6">
            @include('pages.profile.sections.following')
        </div>
        <div class="col-md-6">
            @include('pages.profile.sections.followers')
        </div>
    </div>
@endsection


