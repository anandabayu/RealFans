@extends('pages.layout')

@section('pages')
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @include('pages.profile.sections.avatar')
    @include('pages.profile.sections.info')
@endsection


