require('chart.js/dist/chart.min');
$(document).ready(function($){
    $('#dataTable').DataTable();

    // Confirm delete
    $('.delete-js').click((e) => {
        let gameId = $(e.currentTarget).data('id');
        $('#delete_id').val(gameId)
        $('#confirm-delete form span').text($(e.currentTarget).data('name'));
        $('#confirm-delete').modal('show');
    })

    // refresh page button
    $('button[data-refresh="refresh"]').click(function(e) {
        e.preventDefault()
        location.reload();
    });
});
