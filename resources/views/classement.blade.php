@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        @foreach($servers as $s)
            <div class="card servers row col-12 mb-4
            @if((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 1)first
            @elseif((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 2)second
            @elseif((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 3)third
            @endif
                ">
                <div class="rank">
                    {{ ($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1}}
                </div>
                <div class="col-12 row border-bottom first-bar">
                    <div class="col-4 text-center votes">
                       Votes : {{ $s->vote }} <i class="far fa-thumbs-up"></i>
                    </div>
                    <div class="col-4 text-center clicks">
                        Clicks : {{ $s->click }} <i class="fas fa-mouse-pointer"></i>
                    </div>
                    <div class="col-4 text-center avis">
                        Avis : <i class="far fa-comment"></i> (nb avis)
                    </div>
                </div>
                <div class="logo">
                    <img src="{{ Storage::disk('s3')->url('media/logo/'.$s->logo->path) }}">
                </div>
                <div class="col-12 row border-bottom">
                    <div class="col-3 row pt-2 pb-2 pr-2">
                        <div class="col-12 banner">
                            <img src="{{ Storage::disk('s3')->url('media/banner/'.$s->banner->path) }}">
                        </div>
                    </div>
                    <div class="col-9 p-2 description">
                        <p>{{ $s->description }}</p>
                    </div>
                </div>
                <div class="col-3 row slots-ip">
                    <div class="slots m-auto">
                        <span>0/{{ $s->slots }} players</span>
                    </div>
                    <div class="access">
                        @if($s->access == 0)
                        <i class="fas fa-unlock"></i>
                        @else
                        <i class="fas fa-lock"></i>
                        @endif
                    </div>
                    <div class="col-12 ip">
                        <span>IP : {{ $s->ip }}</span>
                    </div>
                </div>
                <div class="col-9 row tags-langs">
                    <div class="col-12 row">
                        <div class="col-5 tags">
                            @forelse($s->tags as $tag)
                                @if($loop->index <= 5)
                                    <span class="badge badge-primary">{{ $tag->name }}</span>
                                @else
                                     @if($loop->count >= 6)
                                    <span class="badge badge-warning">+{{ $loop->count - ($loop->index) }}</span>
                                    @endif
                                    @break
                                @endif
                                @empty
                            @endforelse
                        </div>
                        <div class="col-5 langs">
                            <span>Langs :</span>
                            @forelse($s->languages as $lang)
                                @if($loop->index <= 5)
                                    <img src="{{asset('media/'.$lang->image->path)}}">
                                @else
                                @if($loop->count >= 6)
                                    <span class="badge badge-warning">+{{ $loop->count - ($loop->index) }}</span>
                                @endif
                                @break
                            @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-6 text-center">
                            <button class="btn btn-outline-success">{{ __('Voir le serveur') }}</button>
                        </div>
                        <div class="col-6 text-center">
                            <a href="{{ route('serverVote', ['game' => $s->game->slug,'server' => $s->slug]) }}"><button class="btn btn-outline-info">{{ __('Voter') }}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $servers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
