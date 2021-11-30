@extends('layouts.app')

@section('content')
<div class="container-lg">
    <div class="row justify-content-center">
        @foreach($servers as $s)
            {{ $s->name }}
        @endforeach
        {{ $servers->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
