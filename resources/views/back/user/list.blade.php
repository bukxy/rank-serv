@extends('back.layouts.main')

@section('pageTitle')
    Liste des utilisateurs
@endsection

@section('content')
<div class="container-fluid mt-5">

    <!-- Page Heading -->

    @include('flash-message')

    <div class="card shadow mb-4">
        <div class="card-header py-3 row">
            <div class="col-11 align-items-center d-flex">
                <h6 class="font-weight-bold align-items-center text-primary mb-0">@yield('pageTitle')</h6>
            </div>
            <div class="col-1 d-flex">
                <button class="btn btn-success">
                    <a class="text-decoration-none text-gray-900" href="{{ route('back.addUser') }}">
                        Nouvel utilisateur
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
                            <th class="col-6 text-center">Pseudo</th>
                            <th class="col-2 text-center">email</th>
                            <th class="col-1 text-center">Servers</th>
                            <th class="col-1 text-center">Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td class="text-center align-middle p-1">{{ $u->id }}</td>
                                <td class="text-center align-middle p-1">{{ $u->pseudo }}</td>
                                <td class="text-center align-middle p-1">{{ $u->email }}</td>
                                <td class="text-center align-middle p-1">{{ count($u->servers) }}</td>
                                <td class="text-center align-middle p-1">
                                    <a href="{{ route('back.editUser', ['id' => $u->id]) }}" class="btn btn-info btn-circle btn-sm"><i class="far fa-edit"></i></a>
                                    <button type="button" value="{{ $u->id }}" class="btn btn-danger btn-sm delete-js"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-1 text-center">#</th>
                            <th class="col-2 text-center">Name</th>
                            <th class="col-2 text-center">Email</th>
                            <th class="col-1 text-center">Servers</th>
                            <th class="col-1 text-center">Settings</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/back/game.js') }}"></script>
@endsection
