$(document).ready(function () {
    function checkCoreUpdates(version)
    {
        var el = $('.dashboard-core .core-version');
        var currentVersion = el.data('current');

        if (version != currentVersion) {
            el.attr('title', 'Jest nowsza wersja oprogramowania, która oczekuje na aktualizację.');
            el.html('Wersja: ' + currentVersion + '<BR /> Nowsza wersja: ' + version);
            $('.dashboard-core').find('[data-action="upgrade-core"]').removeClass('d-none');
        } else {
            $('.dashboard-core').find('[data-action="upgrade-core"]').addClass('d-none');
        }
    }

    function getLog(url) {
        var logs = [];
        return setInterval(function () {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (d) {
                    if (d.prepared != null) {
                        logs = d.prepared;
                    }

                    $('.list-log').html('');

                    $.each(logs, function (key, row) {
                        $('.list-log').append(`
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <small class="mb-1">`+ row.info +`</small>
                                    <small class="text-muted">`+ row.data +`</small>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }, 1000);
    }

    var getLogsCore;
    $('button[data-action]').on('click load', function () {
        var self = this;
        $(self).append(' <i class="fa fa-spinner fa-spin button-spinner"></i>');
        var type = $(self).data('action');
        var allowed = ['check-upgrade-core', 'upgrade-core', 'upgrade-system', 'latest-system-changes'];
        var url = $(self).data('url');
        var log = $(self).data('log');

        if (type == 'upgrade-core') {
            getLogsCore = getLog(log);
            $('.logs').removeClass('d-none');
        }

        if (allowed.includes(type)) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (d) {
                    if (type == 'check-upgrade-core') {
                        checkCoreUpdates(d.version);
                        $(self).find('.button-spinner').remove();
                    }

                    if (type == 'upgrade-core') {
                        if (d == 200) {
                            clearInterval(getLogsCore);
                            $(self).find('.button-spinner').remove();
                        }
                    }
                }
            });
        }
    });

    var dash = $(this).find('.dashboard-core');

    if (dash.length > 0) {
        var action = $(this).find('button[data-action="check-upgrade-core"]').data('url');

        $.ajax({
            url: action,
            type: 'GET',
            dataType: 'json',
            success: function (d) {
                checkCoreUpdates(d.version);
            }
        });
    }
});
