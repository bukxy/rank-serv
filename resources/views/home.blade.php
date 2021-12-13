@extends('layouts.app')

@section('content')
<section class="container-lg">
    <ul class="row justify-content-center">
        @foreach($games as $g)
            <li class="game-card">
                <figure>
                    <a href="{{ route('listServersByGame', ['game' => $g->slug]) }}">
                        <img src="{{ asset('media/ws/' . $g->image->path) }}" alt="{{ $g->name }}">
                    </a>
                    <figcaption>
                        <h5 class="game-card-bottom"><a href="{{ route('listServersByGame', ['game' => $g->slug]) }}" class="stretched-link">{{ $g->name }}</a></h5>
                        <span>{{ count($g->servers) }} serveurs</span>
                        <span class="badge badge-light">{{ count($g->tags) }} tags</span>
                    </figcaption>
                </figure>
            </li>
        @endforeach
    </ul>
</section>
@endsection
