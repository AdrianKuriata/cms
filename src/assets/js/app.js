require('./bootstrap/bootstrap.js');

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

window.Vue = require('vue');

require('vali-admin/docs/js/main.js');

// Components
require('./components/repositories.js');

// Validation
require('./partials/validation.js');
