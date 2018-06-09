$(document).ready(function () {
    $('.delete-item').on('click', function (e) {
        e.preventDefault();
        if (confirm('Jesteś pewny, że chcesz to zrobić? Ta opcja jest nieodwracalna!')) {
            let url = $(this).data('href');

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            });
        }
    });
});
