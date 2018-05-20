$(document).ready(function () {
    $('.delete-item').on('click', function (e) {
        e.preventDefault();
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
    });
});
