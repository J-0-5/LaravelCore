require('./bootstrap');
import { BootstrapVue, IconsPlugin, SidebarPlugin } from 'bootstrap-vue'

window.Vue = require('vue');

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(SidebarPlugin)

import Users from '../../app/Modules/UserModule/views/js/_users';

// import Addresses from '../../app/Modules/AddressModule/views/js/_addresses';
import General from './_general';
import Permissions from '../../app/Modules/PermissionModule/views/js/_permissions';
import Parameters from '../../app/Modules/ParametersModule/views/js/_parameters';
import Configuration from '../../app/Modules/ConfigModule/views/js/_config';
import Notifications from './_notifications';
import Booster from './booster';



//Vue Components


let general = new General();
let booster = new Booster();
let users = new Users();
let permissions = new Permissions();
let parameters = new Parameters();
let notifications = new Notifications();
let configuration = new Configuration();


// const app = new Vue({
//     el: '#app'
// });


document.addEventListener("DOMContentLoaded", function (event) {
    $('.select2').select2();
    $('.set').select2({
        dropdownCssClass: 'setting',
        dropdownAutoWidth: true
    });
    general.initialize();
    booster.initialize();
    users.initialize();
    permissions.initialize();
    parameters.initialize();
    notifications.initialize();
    configuration.initialize();
});
