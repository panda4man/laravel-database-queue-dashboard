import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Jobs from './components/Jobs.vue';
import FailedJobs from './components/FailedJobs.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/jobs',
            name: 'jobs',
            component: Jobs
        },
        {
            path: '/failed-jobs',
            name: 'failed-jobs',
            component: FailedJobs
        }
    ]
});

export default router;
