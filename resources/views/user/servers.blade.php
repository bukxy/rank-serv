@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('user.nav')
        @foreach($servers as $serv)
            {{ $serv }}
            <button class="btn btn-outline-secondary"><a href="{{ route('my-servers.edit', ['slug' => $serv->slug]) }}">Edit server</a></button>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/front/serverLangsList.js') }}"></script>
@endsection
