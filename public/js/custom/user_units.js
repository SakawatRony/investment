'use strict'

$('#user_id').select2({
    placeholder: 'Search User Name or Phone…',
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

document.getElementById('total_number').addEventListener('input', function () {
    let v = this.value;
    // remove decimal
    if (v.includes('.')) v = v.split('.')[0];
    // remove leading zero
    v = v.replace(/^0+/, '');
    // enforce positive
    if (v === '' || Number(v) < 1) v = '';
    this.value = v;
});
