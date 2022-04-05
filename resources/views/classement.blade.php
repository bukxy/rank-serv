@extends('layouts.app')

@section('content')
<div class="container-xxl row justify-content-center">
    <div class="col-4 filter">
        <div class="col-12 text-center p-2">
            <h5>Filters</h5>
        </div>
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
        <div>
            <form method="post" action="{{ route('game.server.filter', ['game' => $game->slug]) }}">
                <div class="col-12">
                    <label for="name">Search by name</label>
                    <input type="text" class="form-control form-control-sm" id="name" placeholder="The server name" name="name">
                </div>
                <div class="col-12 d-flex flex-column vote">
                    <div class="col-12">
                        <label for="min">Vote(s) Range</label>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="form-group col-5">
                            <input type="text" class="form-control form-control-sm" id="min" placeholder="50" name="voteMin">
                        </div>
                        <span class="col-2 text-center">/</span>
                        <div class="form-group col-5">
                            <input type="text" class="form-control form-control-sm" placeholder="1000" name="voteMax">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="host">Server Location</label>
                    <select class="form-control js-add-server-lang" id="host" name="host[]" multiple="multiple">
                        @forelse($languages as $l)
                            <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                        @empty
                            <option selected="selected" value="">{{ __('NONE') }}</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-12">
                    <label for="lang">Server Languages</label>
                    <select class="form-control js-add-server-lang" id="lang" name="lang[]" multiple="multiple">
                        @forelse($languages as $l)
                            <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                        @empty
                            <option selected="selected" value="">{{ __('NONE') }}</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-12">
                    <div class="col-12">
                        <label for="tag">Server Tags</label>
                    </div>
                    <select class="form-control js-add-server-lang" id="tag" name="tag[]" multiple="multiple">
                        @forelse($tags as $t)
                            <option selected="selected" value="{{ $t->id }}">{{ $t->name }}</option>
                        @empty
                            <option selected="selected" value="">{{ __('NONE') }}</option>
                        @endforelse
                    </select>
                </div>
                <div class="col-12 row">
                    <ul>
                        <li>
                            <input class="form-check-input" type="radio" name="access" id="flexRadioDefault1" value="2" checked>
                            <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="access" id="flexRadioDefault2" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">{{__('Free')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="access" id="flexRadioDefault3" value="1">
                            <label class="form-check-label" for="flexRadioDefault3">{{__('Whitelist')}}</label>
                        </li>
                    </ul>
                </div>
                <div class="col-12 row">
                    <div class="col-12">
                        <h6>Have a website ?</h6>
                    </div>
                    <ul>
                        <li>
                            <input class="form-check-input" type="radio" name="website" id="flexRadioDefault1" value="2" checked>
                            <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="website" id="flexRadioDefault2" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="website" id="flexRadioDefault3" value="1">
                            <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                        </li>
                    </ul>
                </div>
                <div class="col-12 row">
                    <div class="col-12">
                        <h6>Have a discord ?</h6>
                    </div>
                    <ul>
                        <li>
                            <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault1" value="2" checked>
                            <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault2" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault3" value="1">
                            <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                        </li>
                    </ul>
                </div>
                <div class="col-12 row">
                    <div class="col-12">
                        <h6>Have a teamspeak ?</h6>
                    </div>
                    <ul>
                        <li>
                            <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault1" value="2" checked>
                            <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault2" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault3" value="1">
                            <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                        </li>
                    </ul>
                </div>
                <div class="col-12 row">
                    <div class="col-12">
                        <h6>Have a mumble ?</h6>
                    </div>
                    <ul>
                        <li>
                            <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault1" value="2" checked>
                            <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault2" value="0">
                            <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault3" value="1">
                            <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                        </li>
                    </ul>
                </div>
                @csrf
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row col-8 justify-content-between">
        @foreach($servers as $s)
            <div class="card servers col-12 mb-4 flex-row
            @if((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 1)first
            @elseif((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 2)second
            @elseif((($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1) == 3)third
            @endif
                ">

                <span class="rank">
                    # {{ ($servers->currentPage()-1) * $servers->perPage() + $loop->index + 1}}
                </span>
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
                <div class="col-12 row border-bottom position-relative">
                    <div class="logo">
                        @if($s->logo_id)
                            <img src="{{ Storage::disk('s3')->url('media/logo/'.$s->logo->path) }}">
                        @endif
                    </div>
                    <div class="col-3 row pt-2 pb-2 pr-2">
                        <div class="col-12 banner">
                            @if($s->banner_id)
                                <img src="{{ Storage::disk('s3')->url('media/banner/'.$s->banner->path) }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-9 p-2 description">
                        <p>{{ $s->description_short }}</p>
                    </div>
                </div>
                <div class="col-3 row slots-ip position-relative">
                    <div class="slots m-auto">
                        <span>0/{{ $s->slots }} players</span>
                    </div>
                    <div class="row">
                        <div class="host col-6 p-2 text-center">
                            <img src="{{ asset('media/'.$s->host($s->host_id)[1]) }}" data-bs-toggle="tooltip" title="{{ $s->host($s->host_id)[0] }}">
                        </div>
                        <div class="access col-6 p-2 text-center">
                            @if($s->access == 0)
                            <i class="fas fa-unlock"></i>
                            @else
                            <i class="fas fa-lock"></i>
                            @endif
                        </div>
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
                                    <span class="badge bg-primary">{{ $tag->name }}</span>
                                @else
                                    @if($loop->count >= 6)
                                        <span class="badge bg-warning">+{{ $loop->count - ($loop->index) }}</span>
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
                                    <img src="{{asset('media/'.$lang->image->path)}}" data-bs-toggle="tooltip" title="{{ $lang->name }}">
                                @else
                                @if($loop->count >= 6)
                                    <span class="badge bg-warning">+{{ $loop->count - ($loop->index) }}</span>
                                @endif
                                @break
                            @endif
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-6 text-center">
                            <a href="{{ route('server.info', ['game' => $s->game->slug,'server' => $s->slug]) }}"><button class="btn btn-outline-success">{{ __('Voir le serveur') }}</button></a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="{{ route('server.vote', ['game' => $s->game->slug,'server' => $s->slug]) }}"><button class="btn btn-outline-info">{{ __('Voter') }}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $servers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
