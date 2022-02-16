@extends('layouts.app')

@section('head')
    {!! RecaptchaV3::initJs() !!}
@endsection

@section('content')
    <section class="container-lg">
        @include('flash-message')
        @if ($message = Session::get('expiration_date'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Next vote at {{ $message }} (UTC)</strong>
            </div>
        @endif

        <form method="post" action="{{ route('server.voteStore', ['game' => $server->game->slug, 'server' => $server->slug]) }}" id="voteForm">
            <div class="form-group">
                <label for="exampleInputEmail1">Pseudo</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="mypseudo" name="pseudo">
            </div>
            @csrf
            {!! RecaptchaV3::field('vote') !!}
            <div class="form-group">
                <button type="submit" class="btn btn-success">VOTER</button>
            </div>
        </form>
    </section>
@endsection
