@extends('back.layouts.main')

@section('pageTitle')
    {{ __("Game") }}
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->

    @include('flash-message')

    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <div class="col-11 align-items-center d-flex">
                <h6 class="font-weight-bold align-items-center text-primary mb-0">DataTables Example</h6>
            </div>
            <div class="col-1 d-flex">
                <button class="btn btn-success">
                    <a class="text-decoration-none text-gray-900" href="{{ route('back.addGame') }}">
                        New game
                    </a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Servers</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Servers</th>
                            <th>Settings</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->name }}</td>
                            <td><img width="50" height="auto" src="{{ asset('storage/siteImage/'.$game->image->path) }}" alt="{{ $game->alt }}"></td>
                            <td>{{ $game->tag }}</td>
                            <td>{{ $game->servers }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
