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
                    <a class="text-decoration-none text-gray-900" href="#" data-toggle="modal" data-target="#addGameModal">
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

<div class="modal fade" id="addGameModal" tabindex="-1" role="dialog" aria-labelledby="addGameLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGameLabel">Add a new Game</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <form id="addGameForm" method="post" action="{{ route('back.addGame.store') }}">
                <div class="modal-body">
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="website" class="form-label">Game name</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" id="website" name="name" placeholder="Minecraft">
                        </div>
                    </div>
                    <div class="col-12 row">
                        <div class="col-2">
                            <label for="formFile" class="form-label">Image</label>
                        </div>
                        <div class="col-8">
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                    </div>
                </div>
                    @csrf
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#addGameForm').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/game') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    image: $('#image').val(),
                },
                success: function(result){
                    if(result.errors)
                    {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value){
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>'+value+'</li>');
                        });
                    }
                    else
                    {
                        $('.alert-danger').hide();
                        $('#addGameModal').modal('hide');
                    }
                }
            });
        });
    });
</script>
@endsection
