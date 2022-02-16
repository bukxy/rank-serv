@extends('layouts.app')

@section('content')
    <form>
        <div class="col-12 row mb-3">
            <div class="col-3">
                <label for="desc" class="form-label">Description</label>
            </div>
            @error('desc')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="col-9">
                <textarea type="textarea" class="form-control ckeditor" id="desc" name="desc"></textarea>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    @include('ckeditor')
@endsection
