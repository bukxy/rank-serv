$(document).ready(function($) {
    // let editGame = $('.js-add-game-tag')
    // editGame.select2({
    //     tags: true
    // });

    /*
        Add game tag
     */
    let _token = $('meta[name="csrf-token"]').attr('content')
    $('button[data-bs-target="#addGameTag"]').click(function(e) {
        e.preventDefault();
        let id = $(this).data('gameid');
        $("#addGameTag-ajax").on('submit', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
            $.ajax({
                type: "POST",
                url: "/dashboard/game/edit/tag/add",
                data: {
                    _token,
                    gameid: id,
                    name: $('#addGameTag-ajax input[name="name"]').val()
                },
                success: function (res) {
                    let error = $('#addGameTag .alert-danger');
                    let success = $('#addGameTag .alert-success');
                    if (res.status == 400) {
                        if (!success.hasClass('d-none')) {
                            success.addClass('d-none');
                        }
                        $.each(res.errors, function (key, err_value) {
                            error.removeClass('d-none');
                            $('#addGameTag .alert-danger strong').text(err_value);
                        });
                    }
                    if (res.status == 200) {
                        if (!error.hasClass('d-none')) {
                            error.addClass('d-none');
                        }
                        $('#addGameTag input').val('');
                        success.removeClass('d-none');
                        $('#addGameTag .alert-success strong').text(res.success);
                    }
                },
            });
        })
    });

    /*
        Edit game tag
     */
    $('button[data-bs-target="#editGameTag"]').on('click', function(e){
        e.preventDefault();
        let id = $(this).data('gameid');
        $.ajax({
            type: "POST",
            url: "/dashboard/game/edit/tag/" + id,
            data: {id, _token},
            success: function(res){
                let error = $('#editGameTag .alert-danger');
                let success = $('#editGameTag .alert-success')
                let inputReadOnly = $('#editGameTag input[readonly]');
                if(res.status == 400) {
                    if(!success.hasClass('d-none')){
                        success.addClass('d-none');
                    }
                    inputReadOnly.empty();
                    $('#editGameTag .alert-danger strong').text(res.error);
                }
                if(res.status == 200) {
                    if(!error.hasClass('d-none')){
                        error.addClass('d-none');
                    }
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
                                    if(!success.hasClass('d-none')){
                                        success.addClass('d-none');
                                    }
                                    $.each(res.errors, function (key, err_value) {
                                        success.addClass('d-none');
                                        error.removeClass('d-none');
                                        $('#editGameTag .alert-danger strong').text(err_value);
                                    });
                                }
                                if(res.status == 200) {
                                    if(!error.hasClass('d-none')){
                                        error.addClass('d-none');
                                    }
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
