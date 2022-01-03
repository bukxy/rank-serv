@extends('back.layouts.main')

@section('pageTitle')
    Edit page
@endsection
@section('confirm-content-name')
    le tag
@endsection

@section('content')
    @include('flash-message')
<form method="post" action="{{ route('back.editGame.store', ['slug' => $game->slug]) }}" enctype="multipart/form-data">
    <div class="col-12 row mb-3">
        @error('name')
            <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="website" class="form-label">{{ __('Game name') }}</label>
        </div>
        <div class="col-8">
            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $game->name }}" name="name" placeholder="Minecraft" required autofocus>
        </div>
    </div>
    <div class="col-12 row mb-3">
        @error('image')
            <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label for="formFile" class="form-label">{{ __('Image') }}</label>
        </div>
        <div class="col-4">
            <img height="auto" width="300" src="{{ asset('media/ws/'.$game->image->path) }}">
        </div>
        <div class="col-4">
            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image">
        </div>
    </div>
    @csrf
    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
</form>

<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3 row">
        <div class="col-11 align-items-center d-flex">
            <h6 class="font-weight-bold align-items-center text-primary mb-0">Liste des tags</h6>
        </div>
        <div class="col-1 d-flex">
            <button class="btn btn-success text-decoration-none text-gray-900" data-gameId="{{$game->id}}" data-toggle="modal" data-target="#addGameTag">
                New tag
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
                    <th class="col-1 text-center">Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach($game->tags as $tag)
                    <tr>
                        <td class="text-center align-middle">{{ $tag->id }}</td>
                        <td class="text-center align-middle">{{ $tag->name }}</td>
                        <td class="text-center align-middle">
                            <button type="button" data-toggle="modal" data-target="#editGameTag" data-gameId="{{ $tag->id }}" class="btn btn-info btn-circle"><i class="far fa-edit"></i></button>
                            <button type="button" data-id="{{ $tag->id }}" data-name="{{ $tag->name }}" class="btn btn-danger delete-js"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="col-1 text-center">#</th>
                    <th class="col-2 text-center" >Name</th>
                    <th class="text-center">Settings</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

    {{----------------------------
        MODAL ADD GAME TAG
    ----------------------------}}
<div class="modal fade" id="addGameTag" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouveau tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="addGameTag-ajax">
                <div class="modal-body">
                    <div class="alert alert-success text-center alert-block d-none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong></strong>
                    </div>
                    <div class="alert alert-danger text-center alert-block d-none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong></strong>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">tag name</span>
                        </div>
                        <input type="text" class="form-control" name="name">
                    </div>
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-refresh="refresh" data-dismiss="modal">Terminer les ajouts</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

    {{----------------------------
        MODAL EDIT GAME TAG
    ----------------------------}}
<div class="modal fade" id="editGameTag" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edition du tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="editGameTag-ajax">
                <div class="modal-body">
                    <div class="alert alert-success text-center alert-block d-none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong></strong>
                    </div>
                    <div class="alert alert-danger text-center alert-block d-none">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong></strong>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Old Name</span>
                        </div>
                        <input type="text" class="form-control old-value" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">New Name</span>
                        </div>
                        <input type="text" class="form-control" name="name">
                    </div>
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-refresh="refresh" data-dismiss="modal">Terminer les modifications</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('back.deleteGameTag.store')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_id" name="id">
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Êtes vous sûr de bien vouloir supprimer le tag "<span class="font-weight-bold"></span>"
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
    <script type="text/javascript" src="{{asset('js/back/game.js')}}"></script>
@endsection
