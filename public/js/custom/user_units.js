'use strict'

$('#user_id').select2({
    placeholder: 'Search User Name…',
    minimumInputLength: 2,
    ajax: {
        url: SITE_URL + "/users/search",
        dataType: 'json',
        delay: 500,
        data: function(params) {
            return { q: params.term };
        },
        processResults: function(data) {
            return {
                results: data
            };
        }
    }
});
