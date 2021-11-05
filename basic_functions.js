$(document).ready(function() {
    $(".delete_link").on('click', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var whereLink = $(this).attr('href');
        var wantDelete = confirm("¿Realmente desea eliminar este registro?");
        if (wantDelete) {
            window.location.href = whereLink;
        }
    });
});