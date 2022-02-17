import Vue from 'vue'
import './components';
import './plugins';
import router from './router/index'
import store from './store/index'
import App from "./components/App";

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
