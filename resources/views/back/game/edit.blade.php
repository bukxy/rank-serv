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
    <div class="col-12 row">
        <div class="col-3 row card border border-primary border-5 m-auto rounded-1 p-0">
            @error('image')
                <div class="alert alert-danger col-12">{{ $message }}</div>
            @enderror
            <div class="col-12 text-center card-header">
                <h6 class="m-0 fw-bold text-primary">Image</h6>
            </div>
            <div class="col-12">
                <img class="d-block m-auto" height="auto" width="150" src="{{ asset('media/ws/'.$game->image->path) }}">
            </div>
            <div class="col-12 p-2 card-footer">
                <input class="form-control form-control-sm @error('image') is-invalid @enderror" type="file" name="image">
            </div>
        </div>
        <div class="col-3 row card border border-primary border-5 m-auto rounded-1 p-0">
            @error('logo')
            <div class="alert alert-danger col-12">{{ $message }}</div>
            @enderror
            <div class="col-12 text-center  card-header">
                <h6 class="m-0 fw-bold text-primary">Logo</h6>
            </div>
            <div class="col-12">
                <img class="d-block m-auto" height="auto" width="150" src="{{ asset('media/ws/'.$game->logo->path) }}">
            </div>
            <div class="col-12 pt-2 card-footer">
                <input class="form-control form-control-sm @error('logo') is-invalid @enderror" type="file" name="logo">
            </div>
        </div>
    </div>
    <div class="form-switch row mt-3 mb-3 py-2 px-0">
        @error('type')
        <div class="alert alert-danger col-12">{{ $message }}</div>
        @enderror
        <div class="col-2">
            <label class="form-check-label" for="switchType">Type</label>
        </div>
        <div class="col-8">
            <label class="form-check-label" for="switchType">Game server</label>
            <input class="form-check-input m-1" type="checkbox" role="switch" id="switchType" name="type" @if($game->type == 1) checked @endif>
            <label class="form-check-label" for="switchType">Other server (Voice)</label>
        </div>
    </div>
    @csrf
    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
</form>

<div class="card shadow mb-4 mt-5">
    <div class="card-header py-3 row">
        <div class="col-11 align-items-center d-flex">
            <h6 class="font-weight-bold align-items-center text-primary mb-0">Tags list</h6>
        </div>
        <div class="col-1 d-flex">
            <button class="btn btn-success text-decoration-none text-gray-100" data-gameId="{{$game->id}}" data-bs-toggle="modal" data-bs-target="#addGameTag">
                Add
            </button>
        </div>
    </div>
    <div class="card-body p-3 mt-4">
        <div class="col-12 table-responsive-md">
            <table id="dataTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="col-3 text-center">#</th>
                    <th class="col-6 text-center">Name</th>
                    <th class="col-3 text-center">Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach($game->tags as $tag)
                    <tr>
                        <td class="text-center align-middle">{{ $tag->id }}</td>
                        <td class="text-center align-middle">{{ $tag->name }}</td>
                        <td class="text-center align-middle">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#editGameTag" data-gameId="{{ $tag->id }}" class="btn btn-info btn-circle"><i class="far fa-edit"></i></button>
                            <button type="button" data-id="{{ $tag->id }}" data-name="{{ $tag->name }}" class="btn btn-danger delete-js"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="col-3 text-center">#</th>
                    <th class="col-6 text-center" >Name</th>
                    <th class="col-3 text-center">Settings</th>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="addGameTag-ajax">
                <div class="modal-body">
                    <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong></strong>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <button type="button" class="btn btn-outline-secondary" data-refresh="refresh" data-bs-dismiss="modal">Terminer les ajouts</button>
                    <button type="submit" id="addGameTag-submit" class="btn btn-outline-primary">Save</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="editGameTag-ajax">
                <div class="modal-body">
                    <div class="alert alert-success text-center alert-block d-none">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong></strong>
                    </div>
                    <div class="alert alert-danger text-center alert-block d-none">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                    <button type="button" class="btn btn-outline-secondary" data-refresh="refresh" data-bs-dismiss="modal">Terminer les modifications</button>
                    <button type="submit" class="btn btn-outline-primary">Save</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-outline-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/back/game.js')}}"></script>
@endsection
