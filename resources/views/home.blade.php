@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        @foreach($games as $g)
            <a href="{{ route('listServersByGame', ['game' => $g->slug]) }}"><div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/siteImage/' . $g->image->path) }}" class="card-img-top" alt="{{ $g->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $g->name }}</h5>
                </div>
            </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
