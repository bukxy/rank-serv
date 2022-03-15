require('./tinymce');
$(document).ready(function($) {
    $("[data-bs-toggle='tooltip']").tooltip();

    let selectGame = $('.js-single-game');
        selectGame.select2({
            placeholder: 'Select a game'
        });
    let listTag = $('.js-add-server-tag')
        listTag.select2({
            placeholder: 'Select tags'
        });

    let _token = $('input[name="_token"]').val()
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
    let listLang = $('.js-add-server-lang');
    listLang.select2({
        placeholder: 'Select Languages',
    });

    // Vide les champs
    if (!$('form').hasClass('js-server-edit')) {
        selectGame.val(null).trigger('change');
        listHost.val(null).trigger('change');
        listLang.val(null).trigger('change');
    }
});
