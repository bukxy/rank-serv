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
        <div class="card-body p-1 mt-4">
            <div class="table-responsive col-12">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Servers</th>
                        <th>Settings</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td>{{ $game->name }}</td>
                                <td><img width="50" height="auto" src="{{ asset('storage/siteImage/'.$game->image->path) }}" alt="{{ $game->alt }}"></td>
                                <td>{{ $game->tagCount }}</td>
                                <td>{{ $game->servers }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Servers</th>
                        <th>Settings</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
