import Vue from 'vue'
import './components';
import './plugins';
import router from './router/index'
import store from './store/index'
import App from "./components/App";
import vuetify from './vuetify'

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
    render: h => h(App)
});
