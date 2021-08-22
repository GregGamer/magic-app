require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('test');
$('#magic-search').select2({
  placeholder: "Search for cards",
  minimumInputLength: 4,
    ajax: {
      url: '/api/cards/fetch',
      dataType: 'json',
      type: 'GET',
      data: function (params) {

        var queryParameters = {
            term: params.term
        }
        return queryParameters;
      },
      processResults: function (data) {
          return {
              results: $.map(data, function (item) {
                  return {
                      text: item.name,
                      id: item.oracle_id
                  }
              })
          };
      },
    }
    });