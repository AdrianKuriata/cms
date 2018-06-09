$(document).ready(function () {
    $('.form-add-edit').on('submit', function (e) {
        // Do zrobienia zmienna z tym formularzem, żeby pracowac tylko na formularzu, który jest wysyłany
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = new FormData(this);
        var form = $(this);

        $(form).find('.is-invalid').removeClass('is-invalid');
        $(form).find('.invalid-feedback').remove();

        $.ajax({
            url: url,
            type: method,
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log('Sending form.');
                $('.form-loader').css('display', 'flex!important');
            },
            success: function (data) {
                console.log('Form was send and got 200 code.');
                console.log(data);

                if (data.redirect) {
                    window.location.href = data.redirect;
                }

                $('form-loader').removeAttr('style');
            },
            error: function (error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (key, row) {
                        $(form).find('[name="'+key+'"]').addClass('is-invalid');
                        $(form).find('[name="'+key+'"]').closest('.form-group').append('<div class="invalid-feedback">'+row[0]+'</div>')
                    });
                }

                $('form-loader').removeAttr('style');
            }
        });
    });
});
