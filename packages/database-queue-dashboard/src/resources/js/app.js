import Vue from 'vue';
import DatabaseQueueDashboard from './components/App.vue';
import router from './router';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Axios from 'axios';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faChartBar, faThList, faSpinner, faClock } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import 'bulma/css/bulma.css';

library.add(faChartBar, faThList, faSpinner, faClock);

Vue.component('font-awesome-icon', FontAwesomeIcon);

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