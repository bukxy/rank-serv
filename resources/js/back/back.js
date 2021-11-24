require('chart.js/dist/chart.min');
$(document).ready(function($){
    $('.js-add-game-tag').select2({
        tags: true
    });

    $('#dataTable').DataTable();
});
