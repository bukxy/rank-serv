@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('user.nav')
        <div class="col-9 border-bottom border-start border-end rounded-bottom">
            <form method="post" action="{{ route('add-server.store') }}">
                <div class="row">
                    <div class="col-lg-2">
                        <label for="game">Select game</label>
                        @error('game')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-7">
                        <div class="form-group">
                            <select class="form-control js-single-game" id="game" name="game">
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}">{{ __($game->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-lg-2">
                            <label for="ip" class="form-label">Server IP</label>
                        </div>
                        @error('ip')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        @error('port')
                            <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IP</span>
                                </div>
                                <input type="text" class="form-control" id="ip" name="ip" placeholder="XXX.XXX.XXX.XXX">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="ip" name="port" placeholder="XXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="website" class="form-label">Server website</label>
                        </div>
                        @error('website')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-8">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://</span>
                                </div>
                                <input type="text" class="form-control" id="website" name="website">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="slots" class="form-label">Slots</label>
                        </div>
                            @error('slots')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <div class="col-4">
                            <input type="number" class="form-control" id="slots" name="slots" placeholder="100">
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="access" class="form-label">Access</label>
                        </div>
                        @error('acces')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-8">
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
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="desc" class="form-label">Description</label>
                        </div>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-10">
                            <textarea type="textarea" class="form-control" id="desc" name="desc"></textarea>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                                <label for="tag">Select tag</label>
                        </div>
                        @error('tag')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-10">
                            <div class="form-group">
                                <select class="form-control js-add-server-tag" id="tag" name="tag[]" multiple="multiple">
                                    <option value="tagId1">Tag Name1</option>
                                    <option value="tagId2">Tag Name2</option>
                                    <option value="tagId3">Tag Name3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="discord" class="form-label">Discord</label>
                        </div>
                        @error('discord')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-8">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://discord.gg/</span>
                                </div>
                                <input type="text" class="form-control" id="discord" name="discord">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-lg-2">
                            <label for="tsip" class="form-label">Teamspeak</label>
                        </div>
                        @error('tsip')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        @error('tsport')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IP</span>
                                </div>
                                <input type="text" class="form-control" id="tsip" name="tsip" placeholder="XXX.XXX.XXX.XXX">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="tsip" name="tsport" placeholder="XXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-lg-2">
                            <label for="mumbleip" class="form-label">Mumble</label>
                        </div>
                        @error('tsip')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        @error('tsport')
                        <div class="alert alert-danger col-6">{{ $message }}</div>
                        @enderror
                        <div class="col-6">
                            <div class="input-group mb-3 col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">IP</span>
                                </div>
                                <input type="text" class="form-control" id="mumbleip" name="mumbleip" placeholder="XXX.XXX.XXX.XXX">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">PORT</span>
                                </div>
                                <input type="text" class="form-control" id="mumbleip" name="mumbleport" placeholder="XXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="twitch" class="form-label">Twitch channel</label>
                        </div>
                        @error('twitch')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-8">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://www.twitch.tv/</span>
                                </div>
                                <input type="text" class="form-control" id="twitch" name="twitch">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="youtube" class="form-label">Youtube video</label>
                        </div>
                        @error('twitch')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-8">
                            <div class="input-group mb-3 col-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                                </div>
                                <input type="text" class="form-control" id="youtube" name="youtube">
                            </div>
                        </div>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
