require('chart.js/dist/chart.min');
$(document).ready(function($){
    $('.js-add-game-tag').select2({
        tags: true
    });

    $('#dataTable').DataTable();

    // Confirm delete
    $('.delete-js').click((e) => {
        let gameId = $(e.currentTarget).val();
        $('#confirm-delete').modal('show');
        $('#delete_id').val(gameId)
    })
});
