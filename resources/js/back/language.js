$(document).ready(function($) {
    $(document).on('submit', '#addLang-ajax' ,function(e){
        e.preventDefault();

        let _token = $('meta[name="csrf-token"]').attr('content')

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
                if(res.status == 400) {
                    $.each(res.errors, function (key, err_value) {
                        $('#addLanguage .alert-danger').removeClass('d-none');
                        $('#addLanguage .alert-danger strong').text(err_value);
                    });
                }
                if(res.status == 200) {
                    $('#addLang-ajax input').val('');
                    $('#addLanguage .alert-success').removeClass('d-none');
                    $('#addLanguage .alert-success strong').text(res.success);
                }
            },
        });
    });
});
