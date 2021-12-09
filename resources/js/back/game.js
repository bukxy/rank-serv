$(document).ready(function($) {
    let editGame = $('.js-add-game-tag')
    editGame.select2({
        tags: true
    });

    /*
    Add game tag
     */
    let _token = $('meta[name="csrf-token"]').attr('content')
    $("#addTag-ajax").on('submit' ,function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        $.ajax({
            type: "POST",
            url: "/dashboard/game/tage/add",
            data: {
                _token
            },
            success: function(res){
                if(res.status == 400) {
                    $.each(res.errors, function (key, err_value) {
                        $('#addTag .alert-danger').removeClass('d-none');
                        $('#addTag .alert-danger strong').text(err_value);
                    });
                }
                if(res.status == 200) {
                    $('#addTag input').val('');
                    $('#addTag .alert-success').removeClass('d-none');
                    $('#addTag .alert-success strong').text(res.success);
                }
            },
        });
    });

    /*
    Edit game tag
     */
    $('button[data-target="#editGameTag"]').on('click', function(e){
        e.preventDefault();
        let id = $(this).data('gameid');
        $.ajax({
            type: "POST",
            url: "/dashboard/game/edit/tag/" + id,
            data: {id, _token},
            success: function(res){
                let error = $('#editGameTag .alert-danger');
                let inputReadOnly = $('#editGameTag input[readonly]');
                if(res.status == 400) {
                    error.removeClass('d-none');
                    inputReadOnly.empty();
                    $('#editGameTag .alert-danger strong').text(res.error);
                }
                if(res.status == 200) {
                    if(!error.hasClass('d-none')){
                        error.addClass('d-none');
                    }
                    inputReadOnly.empty();
                    inputReadOnly.empty();
                    inputReadOnly.val(res.success.name);

                    $("#editGameTag-ajax").on('submit', function(e){
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': _token}
                        });
                        $.ajax({
                            type: "POST",
                            url: "/dashboard/game/edit/tag/store/" + res.success.id,
                            data: {
                                id : res.success.id,
                                name : $('#editGameTag-ajax input[name="name"]').val()
                            },
                            success: function(res){
                                if(res.status == 400) {
                                    $.each(res.errors, function (key, err_value) {
                                        success.addClass('d-none');
                                        error.removeClass('d-none');
                                        $('#editGameTag .alert-danger strong').text(err_value);
                                    });
                                }
                                if(res.status == 200) {
                                    success.removeClass('d-none');
                                    error.addClass('d-none');
                                    $('#editGameTag .alert-success strong').text(res.success);
                                }
                            }
                        })
                    })
                }
            }
        })
    })
})
