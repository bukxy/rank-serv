@extends('back.layouts.main')

@section('pageTitle')
    {{ __("New Game") }}
@endsection

@section('content')
<form method="post" action="{{ route('back.addGame.store') }}" enctype="multipart/form-data">
    <div class="col-12 row">
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
    <div class="col-12 row">
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
    @csrf
    <button class="btn btn-primary" type="submit" data-dismiss="modal">{{ __('Save') }}</button>
</form>
@endsection
