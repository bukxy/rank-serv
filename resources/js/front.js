$(document).ready(function($) {
    let selectGame = $('.js-single-game');
        selectGame.select2({
            placeholder: 'Select a game'
        });
    selectGame.val(null).trigger('change');
    let listTag = $('.js-add-server-tag')
        listTag.select2({
            placeholder: 'Select tags'
        });

    let _token = $('meta[name="csrf-token"]').attr('content')
    selectGame.on('change',function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
        });
        let id = $('.js-single-game option:selected').val()
        $.ajax({
            url: "/my-account/getGameTags/" + id,
            type: "post",
            data: {
                id: id,
                _token: _token
            },
            success: function(res){
                $('.js-add-server-tag option').remove();
                $.each(res.success, (i, item) => {
                    listTag.append($('<option>', {
                        value: item.id,
                        text : item.name
                    }));
                });
            }
        });
    });

    let listHost = $('.js-add-server-host');
    listHost.select2({
        placeholder: 'Select Country',
    });
    listHost.val(null).trigger('change');

    let listLanguage = $('.js-add-server-lang');
    listLanguage.select2({
        placeholder: 'Select lang',
    });
    listLanguage.val(null).trigger('change');
});
