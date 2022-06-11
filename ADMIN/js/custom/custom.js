
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});

 // tooltip demo
 $('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

// popover demo
$("[data-toggle=popover]").popover();

