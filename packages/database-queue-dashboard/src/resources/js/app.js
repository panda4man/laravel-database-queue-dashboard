import Vue from 'vue';
import DatabaseQueueDashboard from './components/App.vue';
import router from './router';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Axios from 'axios';
import 'bulma/css/bulma.css';

Vue.prototype.$Echo = new Echo({
    broadcaster:'pusher',
    key: window.pusher_key,
    cluster: 'us2',
    encrypted: true
});

Vue.prototype.$http = Axios;

const app = new Vue({
    render: h => h(DatabaseQueueDashboard),
    router
}).$mount('#app');