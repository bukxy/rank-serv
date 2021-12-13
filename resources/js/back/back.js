require('chart.js/dist/chart.min');
$(document).ready(function($){
    $('#dataTable').DataTable();

    // Confirm delete
    $('.delete-js').click((e) => {
        $('#confirm-delete form input[name="id"]').val($(e.currentTarget).data('id'));
        $('#confirm-delete form span').text($(e.currentTarget).data('name'));
        $('#confirm-delete').modal('show');
    })

    // refresh page button
    $('button[data-refresh="refresh"]').click(function(e) {
        e.preventDefault()
        location.reload();
    });
});
