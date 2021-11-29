@extends('back.layouts.main')

@section('pageTitle')
    {{ __("Game") }}
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the
        <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
    </p>

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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Tags Number</th>
                            <th>Servers Number</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Tags Number</th>
                            <th>Servers Number</th>
                            <th>Settings</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td><img src="{{ $game->image }}"></td>
                            <td>{{ $game->name }}</td>
                            <td>{{ $game->tags }}</td>
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
