$(document).ready(function($){
    console.log('ok');
    $('#formSubmitAddGame').click(function(e){
        e.preventDefault();
        console.log('ok');
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
