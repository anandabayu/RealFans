@extends('app')

@section('content')
<div class="row mt-3">

    <div class="col-md-3">
        @include('pages/sections/info')
    </div>

    <div class="col-md-9">
        @yield('pages')
    </div>

</div>
@endsection
