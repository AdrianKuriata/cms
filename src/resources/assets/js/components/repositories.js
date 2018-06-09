$(document).ready(function () {
    if ($('#repositories').length) {
        var repositories = new Vue({
            el: '#repositories',
            data: {
                repositories: [],
                waitForRepositories: true,
            },
            created: function () {
                this.loadRepositories();
            },
            methods: {
                loadRepositories: function () {
                    var url = $(this.$options.el).data('loadRepositories');
                    this.repositories = [];
                    var self = this;

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'GET',
                        beforeSend: function () {
                            self.waitForRepositories = true;
                        },
                        success: function (d) {
                            self.repositories = d.repositories;
                            self.waitForRepositories = false;
                            $('#repository-count').text(d.repositories_count);
                        }
                    });
                }
            }
        });

        $('#repositories-refresh').on('click', function () {
            repositories.loadRepositories();
        });

        $('#repositories-upgrade').on('click', function () {
            var url = $(this).data('url');
            repositories.repositories = [];

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                    repositories.waitForRepositories = true;
                },
                success: function (d) {
                    if (d.outputAssets) {
                        $('#display-update-info').removeClass('d-none').append('<li class="list-group-item">'+ d.outputAssets +'</li>');
                    }

                    if (d.outputUpgrade) {
                        console.log(d.outputUpgrade);
                        $.each(d.outputUpgrade, function (key, row) {
                            $('#display-update-info').removeClass('d-none').append('<li class="list-group-item">'+ row.message +'</li>');
                        });
                    }
                    repositories.waitForRepositories = false;
                    repositories.loadRepositories();
                }
            });
        });
    }
});
