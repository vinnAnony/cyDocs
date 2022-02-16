import Vue from 'vue'

import MainComponent from './components/App';
import Login from "./components/auth/Login";
import SignUp from "./components/auth/SignUp";

Vue.component("main-component",MainComponent);
Vue.component("login-component",Login);
Vue.component("register-component",SignUp);
