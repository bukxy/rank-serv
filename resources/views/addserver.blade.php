@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('user.nav')
        <div class="col-9 border-bottom border-start border-end rounded-bottom">
            <form method="post" action="{{ route('add-server.store') }}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="game">Select game</label>
                            @error('game')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <select class="form-control js-single-game" id="game" name="game">
                                    @foreach($games as $game)
                                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-3">
                            <label for="game">Select game</label>
                            @error('banner')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="banner">Banner</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="banner" name="banner">
                            <label class="custom-file-label" for="banner">Choose file</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="col-3">
                            <label for="game">Select game</label>
                            @error('logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="logo">Logo</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Choose file</label>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="name" class="form-label">Name</label>
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="My server name">
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
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
                                <input type="text" class="form-control" id="ip" name="ip" value="{{ old('ip') }}" placeholder="XXX.XXX.XXX.XXX">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="ip" name="port" value="{{ old('port') }}" placeholder="XXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="tag">Server location</label>
                        </div>
                        @error('host')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <div class="form-group">
                                <select class="form-control js-add-server-host" name="host">
                                    @foreach($languages as $l)
                                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
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
                                <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="slots" class="form-label">Slots</label>
                        </div>
                            @error('slots')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <div class="col-9">
                            <input type="number" class="form-control" id="slots" name="slots" placeholder="100" value="{{ old('slots') }}">
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="access" class="form-label">Access</label>
                        </div>
                        @error('acces')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="access" id="free" value="0" checked>
                                <label class="form-check-label" for="free">Free Acces</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="access" id="whitelist" value="1">
                                <label class="form-check-label" for="whitelist">Whitelist</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="desc" class="form-label">Description</label>
                        </div>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <textarea type="textarea" class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="tag">Language(s) authorized in the server</label>
                        </div>
                        @error('lang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <div class="form-group">
                                <select class="form-control js-add-server-lang" id="lang" name="lang[]" multiple="multiple">
                                    @foreach($languages as $l)
                                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="tag">Tags</label>
                        </div>
                        @error('tag')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <div class="form-group">
                                <select class="form-control js-add-server-tag" id="tag" name="tag[]" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
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
                                <input type="text" class="form-control" id="discord" name="discord" value="{{ old('discord') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="tsip" class="form-label">Teamspeak</label>
                        </div>
                        @error('tsip')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        @error('tsport')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IP</span>
                                </div>
                                <input type="text" class="form-control" id="tsip" name="tsip" placeholder="XXX.XXX.XXX.XXX" value="{{ old('tsip') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="tsport" name="tsport" placeholder="XXXXX" value="{{ old('tsport') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="mumbleip" class="form-label">Mumble</label>
                        </div>
                        @error('mumbleip')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        @error('mumbleport')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IP</span>
                                </div>
                                <input type="text" class="form-control" id="mumbleip" name="mumbleip" placeholder="XXX.XXX.XXX.XXX" value="{{ old('mumbleip') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="mumbleport" name="mumbleport" placeholder="XXXXX" value="{{ old('mumbleport') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
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
                                <input type="text" class="form-control" id="twitch" name="twitch" value="{{ old('twitch') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row mb-3">
                        <div class="col-3">
                            <label for="youtube" class="form-label">Youtube video</label>
                        </div>
                        @error('youtube')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                                </div>
                                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube') }}">
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

@section('scripts')
    <script src="{{ asset('js/front/serverLangsList.js') }}"></script>
@endsection
