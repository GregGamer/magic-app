require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$('#magic-search').select2({
    placeholder: "Search for cards",
    minimumInputLength: 4,
    ajax: {
        url: 'https://api.scryfall.com/cards/search',
        dataType: 'json',
        type: 'GET',
        data: function (params) {
            var queryParameters = {
                q: 'name:' + params.term
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: $.map(data.data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    };
                })
            };
        },
    }
});
