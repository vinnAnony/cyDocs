import './components';

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
});
