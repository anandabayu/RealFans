@extends('pages.layout')

@section('pages')
    <div class="row">

        <div class="col-md-7">
            @include('pages.home.sections.post')
            @include('pages.home.sections.content')
        </div>

        <div class="col-md-5">
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

            @include('pages.home.sections.follow')
        </div>

    </div>
@endsection
