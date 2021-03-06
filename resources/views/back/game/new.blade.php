@extends('back.layouts.main')

@section('pageTitle')
    {{ __("New Game") }}
@endsection

@section('content')
<form method="post" action="{{ route('back.addGame.store') }}" enctype="multipart/form-data">
    <div class="col-12 row mb-3">
        @error('name')
            <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="website" class="form-label">{{ __('Game name') }}</label>
        </div>
        <div class="col-8">
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="website" name="name" placeholder="Minecraft" required autofocus>
        </div>
    </div>
    <div class="col-12 row mb-3">
        @error('logo')
            <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="formFile" class="form-label">{{ __('Logo') }}</label>
        </div>
        <div class="col-8">
            <input class="form-control @error('logo') is-invalid @enderror" type="file" name="logo" required>
        </div>
    </div>
    <div class="col-12 row mb-3">
        @error('image')
            <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="formFile" class="form-label">{{ __('Image') }}</label>
        </div>
        <div class="col-8">
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" required>
        </div>
    </div>
    <div class="col-12 row">
        @error('tag')
        <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="tag">Select tag</label>
        </div>
        <div class="col-8">
            <div class="form-group">
                <select class="form-control js-add-game-tag" id="tag" name="tag[]" multiple="multiple"></select>
            </div>
        </div>
    </div>
    <div class="form-switch row py-2 px-0">
        @error('type')
        <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label class="form-check-label" for="switchType">Type</label>
        </div>
        <div class="col-8">
            <label class="form-check-label" for="switchType">Game server</label>
            <input class="form-check-input m-1" type="checkbox" role="switch" id="switchType">
            <label class="form-check-label" for="switchType">Other server (Voice)</label>
        </div>
    </div>
    @csrf
    <button class="btn btn-primary" type="submit" data-dismiss="modal">{{ __('Save') }}</button>
</form>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/back/game.js') }}"></script>
@endsection
