require('chart.js/dist/chart.min');
$(document).ready(function($){
    $('#dataTable').DataTable();

    // Confirm delete
    $('.delete-js').click((e) => {
        let gameId = $(e.currentTarget).val();
        $('#confirm-delete').modal('show');
        $('#delete_id').val(gameId)
    })

    $('#refresh').click(function(e) {
        e.preventDefault()
        location.reload();
    });
});
