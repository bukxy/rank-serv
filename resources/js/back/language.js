$(document).ready(function($) {
    let _token = $('meta[name="csrf-token"]').attr('content')
    /*
        Add Lang
    */
    $('#addLang-ajax').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData($('#addLang-ajax')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        $.ajax({
            type: "POST",
            url: "/dashboard/language",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res){
                let error = $('#addLanguage .alert-danger');
                let success = $('#addLanguage .alert-success');
                if(res.status == 400) {
                    if (!success.hasClass('d-none')) {
                        success.addClass('d-none');
                    }
                    $.each(res.errors, function (key, err_value) {
                        error.removeClass('d-none');
                        $('#addLanguage .alert-danger strong').text(err_value);
                    });
                }
                if(res.status == 200) {
                    if (!error.hasClass('d-none')) {
                        error.addClass('d-none');
                    }
                    $('#addLanguage input').val('');
                    success.removeClass('d-none');
                    $('#addLanguage .alert-success strong').text(res.success);
                }
            },
        });
    });

    /*
        Edit Lang
     */
    $('button[data-target="#editLanguage"]').on('click', function(e){
        e.preventDefault();
        let id = $(this).data('langid');
        $.ajax({
            type: "POST",
            url: "/dashboard/language/edit/" + id,
            data: {id, _token},
            success: function(res){
                let error = $('#editLanguage .alert-danger');
                let success = $('#editLanguage .alert-success')
                let inputReadOnly = $('#editLanguage span.old-nameValue');
                if(res.status == 400) {
                    if(!success.hasClass('d-none')){
                        success.addClass('d-none');
                    }
                    inputReadOnly.empty();
                    $('#editLanguage .alert-danger strong').text(res.error);
                }
                if(res.status == 200) {
                    if(!error.hasClass('d-none')){
                        error.addClass('d-none');
                    }
                    inputReadOnly.empty();
                    inputReadOnly.text(' "'+res.success.name+'"');
                    $("#editLang-ajax").on('submit', function(e){
                        e.preventDefault();
                        let formData = new FormData($('#editLang-ajax')[0]);
                        $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': _token}
                        });
                        $.ajax({
                            type: "POST",
                            url: "/dashboard/language/edit/store/" + res.success.id,
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(res){
                                if(res.status == 400) {
                                    if(!success.hasClass('d-none')){
                                        success.addClass('d-none');
                                    }
                                    $.each(res.errors, function (key, err_value) {
                                        success.addClass('d-none');
                                        error.removeClass('d-none');
                                        $('#editLanguage .alert-danger strong').text(err_value);
                                    });
                                }
                                if(res.status == 200) {
                                    if(!error.hasClass('d-none')){
                                        error.addClass('d-none');
                                    }
                                    $('#editLanguage input').val('');
                                    success.removeClass('d-none');
                                    error.addClass('d-none');
                                    $('#editLanguage .alert-success strong').text(res.success);
                                }
                            }
                        })
                    })
                }
            }
        })
    })
});
