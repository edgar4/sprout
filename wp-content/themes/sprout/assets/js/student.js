/**
 * Created by edgarchris on 1/12/17.
 */
jQuery(document).ready(function () {
    console.log('table');
    jQuery('#report-datatable').dataTable({
        "order": [[1, "desc"], [0, "desc"]],
        "paging": false,
        "ordering": false,
        "info": false,
        "filter": false,
        "columnDefs": [{"targets": [0, 1, 2, 3, 4, 5], "orderable": false}]
    });
    var table = jQuery('#report-datatable').DataTable();
    var column = table.column("6");
    column.visible(column.visible());
    jQuery('.button_quote').click(function(){

        alert('clikced');

    });
});