import Vue from 'vue'

import MainComponent from './components/App';
import Login from "./components/auth/Login";
import SignUp from "./components/auth/SignUp";
import NavBar from "./components/ui/NavBar";
import Sidebar from "./components/ui/Sidebar";
import UserDropdown from "./components/ui/UserDropdown";

Vue.component("main-component",MainComponent);
Vue.component("login-component",Login);
Vue.component("register-component",SignUp);
Vue.component("navbar-component",NavBar);
Vue.component("sidebar-component",Sidebar);
Vue.component("userdropdown-component",UserDropdown);

import { Datetime } from 'vue-datetime';

Vue.component('datetime', Datetime);
