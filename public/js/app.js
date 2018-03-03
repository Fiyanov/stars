$(document).ready(function() {
    function person(id) {
        history.pushState({}, '', '/person/' + id);

        $.get('/api/getActor/' + id, function(response) {
            response = JSON.parse(response);
            var template = $('#tmp_person').html();
            var rendered = Mustache.render(template, response);

            $('#container').html(rendered);
        });
    }
    
    function list() {
        $.get('/api/getActorList', function(response) {
            response = JSON.parse(response);
            var template = $('#tmp_list').html();
            var rendered = Mustache.render(template, {persons: response});

            $('#container').html(rendered);
        });
    }

    window.onpopstate = function (event) {
        var path = location.pathname;

        if (path == "/") {
            list();
        }
    }

    //Events
    $(document).on('focus', '#search:not(.ui-autocomplete-input)', function (e) {
        $(this).autocomplete({
            source: "/api/getActorList",
            minLength: 3,
            select: function( event, ui ) {
                person(ui.item.value);
            }
        });
    });

    $(document).on('keyup', '#search', function(e) {
        if (e.which == 13) {
            $.get('/api/getActorList?term=' + $('#search').val(), function(response) {
                response = JSON.parse(response);
                var template = $('#tmp_list').html();
                var rendered = Mustache.render(template, {persons: response});

                $('#container').html(rendered);
            });
        }
    });

    $(document).on('click', '#list .item', function(e) {
        person($(e.currentTarget).data('id'));
    });
});