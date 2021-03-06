@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('user.nav')
            <div class="col-9 border-bottom border-start border-end rounded-bottom">
                <form class="js-server-edit" method="post" action="{{ route('my-servers.store', ['slug' => $server->slug]) }}" enctype="multipart/form-data">
                    <div class="d-flex flex-column">
                        <div class="input-group mb-3 d-flex">
                            <div class="col-3">
                                <p>Select banner</p>
                                @error('banner')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="custom-file col-9">
                                <input type="file" class="form-control" id="banner" name="banner">
                            </div>
                        </div>
                        <div class="input-group mb-3 d-flex">
                            <div class="col-3">
                                <p>Select logo</p>
                                @error('logo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="custom-file col-9">
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                        </div>
                        <div class="col-12 mb-3 d-flex position-relative">
                            <div class="col-3">
                                <label for="name" class="form-label">Name</label>
                            </div>
                            @error('name')
                            <div class="invalid-tooltip">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <input type="text" required class="form-control" id="name" name="name" value="{{ $server->name }}" placeholder="My server name">
                            </div>
                        </div>
                        @if($server->game->type == 0)
                            <div class="col-12 d-flex mb-3">
                                <div class="col-lg-3">
                                    <label for="ip" class="form-label">Server infos</label>
                                </div>
                                @error('ip')
                                <div class="alert alert-danger col-6">{{ $message }}</div>
                                @enderror
                                @error('port')
                                <div class="alert alert-danger col-6">{{ $message }}</div>
                                @enderror
                                <div class="col-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">IP</span>
                                        </div>
                                        <input type="text" class="form-control" id="ip" name="ip" value="{{ $server->ip }}" placeholder="XXX.XXX.XXX.XXX">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PORT</span>
                                        </div>
                                        <input type="text" class="form-control" id="ip" name="port" value="{{ $server->port }}" placeholder="XXXXX">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex mb-3">
                                <div class="col-3">
                                    <label for="tag">Server location</label>
                                </div>
                                @error('host_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-9">
                                    <div class="form-group">
                                        <select class="form-control js-add-server-host" name="host_id">
                                            @foreach($languages as $l)
                                                @if ($server->host_id == $l->id)
                                                    <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                                                @endif
                                                <option value="{{ $l->id }}">{{ $l->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="website" class="form-label">Website</label>
                            </div>
                            @error('website')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">https://</span>
                                    </div>
                                    <input type="text" class="form-control" id="website" name="website" value="{{ $server->website }}">
                                </div>
                            </div>
                        </div>

                        @if($server->game->type == 0)
                            <div class="col-12 d-flex mb-3">
                                <div class="col-3">
                                    <label for="slots" class="form-label">Slots</label>
                                </div>
                                @error('slots')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="col-9">
                                    <input type="number" class="form-control" id="slots" name="slots" placeholder="100" value="{{ $server->slots }}">
                                </div>
                            </div>
                        @endif

                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="access" class="form-label">Access</label>
                            </div>
                            @error('access')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="access" id="free" value="0" @if($server->access == 0) checked @endif>
                                    <label class="form-check-label" for="free">Free Acces</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="access" id="whitelist" value="1" @if($server->access == 1) checked @endif>
                                    <label class="form-check-label" for="whitelist">Whitelist</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="desc" class="form-label">Short description</label>
                            </div>
                            @error('description_short')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <small id="emailHelp" class="form-text text-muted">{{ __('What we see in the classement page') }}.</small>
                                <textarea type="textarea" class="form-control" id="desc" data-sid="{{$server->slug}}" name="description_short">{{ $server->description_short }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="desc" class="form-label">Description</label>
                            </div>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <textarea type="textarea" class="form-control tinymce" id="desc" data-sid="{{$server->slug}}" name="description">{{ $server->description }}</textarea>
                            </div>
                        </div>                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="lang">Language(s) authorized in the server</label>
                            </div>
                            @error('lang')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="form-group">
                                    <select class="form-control js-add-server-lang" id="lang" name="lang[]" multiple="multiple">
                                        @forelse($server->languages as $l)
                                            <option selected="selected" value="{{ $l->id }}">{{ $l->name }}</option>
                                            @foreach($languages as $lang)
                                                @if ($lang->id !== $l->id)
                                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                                @endif
                                            @endforeach
                                        @empty
                                            @foreach($languages as $lang)
                                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                            @endforeach
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="tag">Tags</label>
                            </div>
                            @error('tag')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="form-group">
                                    <select class="form-control js-add-server-tag" id="tag" name="tag[]" multiple="multiple">
                                        @forelse($server->tags as $t)
                                            <option selected="selected" value="{{ $t->id }}">{{ $t->name }}</option>
                                            @foreach($tags as $tag)
                                                @if ($tag->id !== $t->id)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endif
                                            @endforeach
                                        @empty
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="discord" class="form-label">Discord</label>
                            </div>
                            @error('discord')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">https://discord.gg/</span>
                                    </div>
                                    <input type="text" class="form-control" id="discord" name="discord" value="{{ $server->discord }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="tsip" class="form-label">Teamspeak</label>
                            </div>
                            @error('teamspeak')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                            @enderror
                            @error('teamspeak_port')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                            @enderror
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IP</span>
                                    </div>
                                    <input type="text" class="form-control" id="tsip" name="teamspeak" placeholder="XXX.XXX.XXX.XXX" value="{{ $server->tsip }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PORT</span>
                                    </div>
                                    <input type="text" class="form-control" id="tsport" name="teamspeak_port" placeholder="XXXXX" value="{{ $server->tsport }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="mumbleip" class="form-label">Mumble</label>
                            </div>
                            @error('mumble')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                            @enderror
                            @error('mumble_port')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                            @enderror
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IP</span>
                                    </div>
                                    <input type="text" class="form-control" id="mumbleip" name="mumble" placeholder="XXX.XXX.XXX.XXX" value="{{ $server->mumbleip }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PORT</span>
                                    </div>
                                    <input type="text" class="form-control" id="mumbleport" name="mumble_port" placeholder="XXXXX" value="{{ $server->mumbleport }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="twitch" class="form-label">Twitch channel</label>
                            </div>
                            @error('twitch')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">https://www.twitch.tv/</span>
                                    </div>
                                    <input type="text" class="form-control" id="twitch" name="twitch" value="{{ $server->twitch }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <div class="col-3">
                                <label for="youtube" class="form-label">Youtube video</label>
                            </div>
                            @error('youtube')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">https://www.youtube.com/</span>
                                    </div>
                                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $server->youtube }}">
                                </div>
                            </div>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
