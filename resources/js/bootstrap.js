
window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('./theme/lib/jquery.min');

    require('bootstrap');
    require('./theme/oneui.app.min');
    require('./pages/be_pages_dashboard_v1');
    require('./pages/be_pages_dashboard');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
