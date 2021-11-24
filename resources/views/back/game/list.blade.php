@extends('back.layouts.main')

@section('pageTitle')
    Liste des Jeux
@endsection

@section('content')
<div class="container-fluid mt-5">

    <!-- Page Heading -->

    @include('flash-message')

    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <div class="col-11 align-items-center d-flex">
                <h6 class="font-weight-bold align-items-center text-primary mb-0">Liste des Jeux</h6>
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
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-1 text-center">#</th>
                            <th class="col-6 text-center">Name</th>
                            <th class="col-2 text-center">Image</th>
                            <th class="col-1 text-center">Tags</th>
                            <th class="col-1 text-center">Servers</th>
                            <th class="col-1 text-center">Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td class="text-center align-middle">{{ $game->id }}</td>
                                <td class="text-center align-middle">{{ $game->name }}</td>
                                <td class="text-center align-middle"><img width="50" height="auto" src="{{ asset('storage/siteImage/'.$game->image->path) }}" alt="{{ $game->name }}"></td>
                                <td class="text-center align-middle">{{ count($game->tags) }}</td>
                                <td class="text-center align-middle">{{ count($game->servers) }}</td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-info btn-circle"><i class="far fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-circle"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-1 text-center">#</th>
                            <th class="col-2 text-center" >Name</th>
                            <th class="col-2 text-center" >Image</th>
                            <th class="col-1 text-center" >Tags</th>
                            <th class="col-1 text-center" >Servers</th>
                            <th class="text-center">Settings</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
