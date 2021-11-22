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
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="tag">Select tag</label>
        </div>
        <div class="col-8">
            <div class="form-group">
                <select class="form-control js-multiple-tag" id="tag" name="tag[]" multiple="multiple">
                    <option value="tagId1">Tag Name1</option>
                    <option value="tagId2">Tag Name2</option>
                    <option value="tagId3">Tag Name3</option>
                </select>
            </div>
        </div>
    </div>
    @csrf
    <button class="btn btn-primary" type="submit" data-dismiss="modal">{{ __('Save') }}</button>
</form>
@endsection
