
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/*
import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '760304ae67eaad314a5b',
    cluster: 'us2',
    auth:
    {
        headers:
        {
            'Authorization': 'Bearer ' + jwtToken.getToken()
        }
    }
});
*/


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('task-list', require('./components/taskList.vue'));

const app = new Vue({
    el: '#app'
});


