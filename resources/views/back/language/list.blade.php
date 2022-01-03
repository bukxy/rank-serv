@extends('back.layouts.main')

@section('pageTitle')
    Liste des languages des serveurs
@endsection

@section('content')
<div class="container-fluid mt-5">

    <!-- Page Heading -->

    @include('flash-message')

    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <div class="col-10 align-items-center d-flex">
                <h6 class="font-weight-bold align-items-center text-primary mb-0">Liste des languages des serveurs</h6>
            </div>
            <div class="col-2 d-flex">
                <button type="button" class="btn btn-success m-auto" data-toggle="modal" data-target="#addLanguage">
                    New language
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
                            <th class="col-1 text-center">Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $l)
                            <tr>
                                <td class="text-center align-middle">{{ $l->id }}</td>
                                <td class="text-center align-middle">{{ $l->name }}</td>
                                <td class="text-center align-middle"><img width="50" height="auto" src="{{ asset('media/'.$l->image->path) }}" alt="{{ $l->name }}"></td>
                                <td class="text-center align-middle">
                                    <button type="button" data-toggle="modal" data-target="#editLanguage" data-langId="{{ $l->id }}" class="btn btn-info btn-circle"><i class="far fa-edit"></i></button>
                                    <button type="button" data-id="{{ $l->id }}" data-name="{{ $l->name }}" class="btn btn-danger delete-js"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-1 text-center">#</th>
                            <th class="col-2 text-center">Name</th>
                            <th class="col-2 text-center">Image</th>
                            <th class="text-center">Settings</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

    {{----------------------------
        MODAL ADD LANG
    ----------------------------}}
<div class="modal fade" id="addLanguage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" id="addLang-ajax">
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
                            <span class="input-group-text">Language name</span>
                        </div>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="file">Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
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
        MODAL EDIT LANG
    ----------------------------}}
<div class="modal fade" id="editLanguage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Language edit <span class="old-nameValue"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="editLang-ajax">
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
                            <span class="input-group-text">New name</span>
                        </div>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="file">New Image</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
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
            <form method="post" action="{{route('back.deleteLanguage.store')}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Êtes vous sûr de bien vouloir supprimer la langue "<span class="font-weight-bold"></span>"
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
    <script type="text/javascript" src="{{ asset('js/back/language.js') }}"></script>
@endsection
