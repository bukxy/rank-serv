@extends('layouts.app')

@section('content')
<div class="container-xxl d-flex justify-content-center">
    <div class="col-4 sticky-top">
        <div class="d-flex filter flex-column">
            <div class="game-card col-12">
                <figure>
                    <a href="{{ route('game.server', ['game' => $game->slug]) }}">
                        <img src="{{ asset('media/ws/' . $game->image->path) }}" alt="{{ $game->name }}">
                    </a>
                    <figcaption>
                        <h5 class="game-card-bottom"><a href="{{ route('game.server', ['game' => $game->slug]) }}" class="stretched-link">{{ $game->name }}</a></h5>
                        <span>{{ count($game->servers) }} serveurs</span>
                    </figcaption>
                </figure>
            </div>
            <div class="col-12">
                <span>0/{{ $server->slots }} players</span>
            </div>
            <div class="col-12 d-flex">
                <div class="row">
                    <div class="host col-6 p-2 text-center">
                        <img src="{{ asset('media/'.$server->host($server->host_id)[1]) }}" data-bs-toggle="tooltip" title="{{ $server->host($server->host_id)[0] }}">
                    </div>
                    <div class="access col-6 p-2 text-center">
                        @if($server->access == 0)
                            <i class="fas fa-unlock"></i>
                        @else
                            <i class="fas fa-lock"></i>
                        @endif
                    </div>
                </div>
                <div class="col-12 ip">
                    <span>IP : {{ $server->ip }}</span>
                </div>
            </div>

            <div>
                Tags :
                @forelse($server->tags as $tag)
                    <span class="badge bg-primary">{{ $tag->name }}</span>
                @empty
                @endforelse
            </div>
            <div>
                Langs :
                @forelse($server->languages as $lang)
                    <img src="{{asset('media/'.$lang->image->path)}}" data-bs-toggle="tooltip" title="{{ $lang->name }}">
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <div class="d-flex col-8">
        <div class="card servers col-12 mb-4">
            <div class="col-12 row border-bottom first-bar">
                <div class="col-4 text-center votes">
                   Votes : {{ $server->vote }} <i class="far fa-thumbs-up"></i>
                </div>
                <div class="col-4 text-center clicks">
                    Clicks : {{ $server->click }} <i class="fas fa-mouse-pointer"></i>
                </div>
                <div class="col-4 text-center avis">
                    Avis : <i class="far fa-comment"></i> (nb avis)
                </div>
            </div>
            <div class="col-12 row position-relative">
                <div class="logo">
                    @if($server->logo_id)
                        <img src="{{ Storage::disk('s3')->url('media/logo/'.$server->logo->path) }}">
                    @endif
                </div>
                <div class="col-3 row pt-2 pb-2 pr-2">
                    <div class="col-12 banner">
                        @if($server->banner_id)
                            <img src="{{ Storage::disk('s3')->url('media/banner/'.$server->banner->path) }}">
                        @endif
                    </div>
                </div>
                <div class="col-9 p-2 description">
                    <p>{!! $server->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
