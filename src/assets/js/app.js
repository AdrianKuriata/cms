require('./bootstrap/bootstrap.js');

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

window.Vue = require('vue');

// COREUI
require('@coreui/ajax/Static_Starter_GULP/src/js/app.js');

// Components
require('./components/repositories.js');

// Validation
require('./partials/validation.js');

// Upgrades
require('./partials/upgrades.js');
