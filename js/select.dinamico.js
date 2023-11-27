document.addEventListener("DOMContentLoaded", function(e) {
    $('#estado').on('change', function() {
        var estadoId = $('#estado').val();
        
        $.ajax({
            type: 'POST',
            url: '../../ajax/fetch_cidade.php',
            data: {estadoId:estadoId},
            success: function(data) {
                $('#cidade').html(data);
            }
        });
    });
});