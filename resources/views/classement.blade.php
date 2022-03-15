@extends('layouts.app')

@section('content')
<div class="container-lg row">
    <div class="row col-4">
        <form method="post" action="{{ route('game.server.filter', ['game' => $game->slug]) }}">
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Search by name</h6>
                </div>
                <div class="form-group col-12">
                    <input type="text" class="form-control form-control-sm" placeholder="The server name" name="name">
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Vote(s) Range</h6>
                </div>
                <div class="form-group col-5">
                    <input type="text" class="form-control form-control-sm" placeholder="50" name="voteMin">
                </div>
                <div class="col-2"><p>/</p></div>
                <div class="form-group col-5">
                    <input type="text" class="form-control form-control-sm" placeholder="1000" name="voteMax">
                </div>
            </div>
            <div class="col-12">
                <div class="col-12">
                    <h6>Server Location</h6>
                </div>
                <select class="form-control js-add-server-lang" name="host[]" multiple="multiple">
                    @forelse($languages as $l)
                        <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                    @empty
                        <option selected="selected" value="">{{ __('NONE') }}</option>
                    @endforelse
                </select>
            </div>
            <div class="col-12">
                <div class="col-12">
                    <h6>Server Languages</h6>
                </div>
                <select class="form-control js-add-server-lang" name="lang[]" multiple="multiple">
                    @forelse($languages as $l)
                        <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                    @empty
                        <option selected="selected" value="">{{ __('NONE') }}</option>
                    @endforelse
                </select>
            </div>
            <div class="col-12">
                <div class="col-12">
                    <h6>Server Tags</h6>
                </div>
                <select class="form-control js-add-server-lang" name="tag[]" multiple="multiple">
                    @forelse($tags as $t)
                        <option selected="selected" value="{{ $t->id }}">{{ $t->name }}</option>
                    @empty
                        <option selected="selected" value="">{{ __('NONE') }}</option>
                    @endforelse
                </select>
            </div>
            <div class="col-12 container row">
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="access" id="flexRadioDefault1" value="2" checked>
                    <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="access" id="flexRadioDefault2" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">{{__('Free access')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="access" id="flexRadioDefault3" value="1">
                    <label class="form-check-label" for="flexRadioDefault3">{{__('Whitelist')}}</label>
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Website</h6>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="website" id="flexRadioDefault1" value="2" checked>
                    <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="website" id="flexRadioDefault2" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="website" id="flexRadioDefault3" value="1">
                    <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Discord Server</h6>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault1" value="2" checked>
                    <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault2" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="discord" id="flexRadioDefault3" value="1">
                    <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Teamspeak Server</h6>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault1" value="2" checked>
                    <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault2" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="teamspeak" id="flexRadioDefault3" value="1">
                    <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                </div>
            </div>
            <div class="col-12 row">
                <div class="col-12">
                    <h6>Mumble Server</h6>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault1" value="2" checked>
                    <label class="form-check-label" for="flexRadioDefault1">{{__('All')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault2" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">{{__('Yes')}}</label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" type="radio" name="mumble" id="flexRadioDefault3" value="1">
                    <label class="form-check-label" for="flexRadioDefault3">{{__('No')}}</label>
                </div>
            </div>
            @csrf
            <button type="submit">Send</button>
        </form>
    </div>

    <div class="row col-8 justify-content-center">
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
                <div class="col-12 row border-bottom position-relative">
                    <div class="logo">
                        <img src="{{ Storage::disk('s3')->url('media/logo/'.$s->logo->path) }}">
                    </div>
                    <div class="col-3 row pt-2 pb-2 pr-2">
                        <div class="col-12 banner">
                            <img src="{{ Storage::disk('s3')->url('media/banner/'.$s->banner->path) }}">
                        </div>
                    </div>
                    <div class="col-9 p-2 description">
                        <p>{{ $s->description }}</p>
                    </div>
                </div>
                <div class="col-3 row slots-ip position-relative">
                    <div class="host" data-bs-toggle="tooltip" title="{{ $s->host($s->host_id)[0] }}">
                        <img src="{{ asset('media/'.$s->host($s->host_id)[1]) }}">
                    </div>
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
                            <button class="btn btn-outline-success">{{ __('Voir le serveur') }}</button>
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
