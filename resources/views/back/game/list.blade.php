@extends('back.layouts.main')

@section('pageTitle')
    Liste des Jeux
@endsection

@section('confirm-content-name')
    le jeu
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
                            <th class="col-2 text-center">logo</th>
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
                                <td class="text-center align-middle"><img width="50" height="auto" src="{{ asset('media/ws/'. $game->logo->path) }}" alt="{{ $game->name }}"></td>
                                <td class="text-center align-middle"><img width="50" height="auto" src="{{ asset('media/ws/'. $game->image->path) }}" alt="{{ $game->name }}"></td>
                                <td class="text-center align-middle">{{ count($game->tags) }}</td>
                                <td class="text-center align-middle">{{ count($game->servers) }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('back.editGame', ['slug' => $game->slug]) }}" class="btn btn-info btn-circle"><i class="far fa-edit"></i></a>
                                    <button type="button" data-id="{{ $game->id }}" data-name="{{ $game->name }}" class="btn btn-danger delete-js"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-1 text-center">#</th>
                            <th class="col-2 text-center">Name</th>
                            <th class="col-2 text-center">logo</th>
                            <th class="col-2 text-center">Image</th>
                            <th class="col-1 text-center">Tags</th>
                            <th class="col-1 text-center">Servers</th>
                            <th class="text-center">Settings</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

{{----------------------------
MODAL CONFIRM DELETE
----------------------------}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('back.deleteGame.store')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        ??tes vous s??r de bien vouloir supprimer le jeu "<span class="font-weight-bold"></span>"
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-danger">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/back/game.js') }}"></script>
@endsection
