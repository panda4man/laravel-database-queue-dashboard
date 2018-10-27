import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import FailedJobs from './components/FailedJobs.vue';
import FailedJob from './components/FailedJob.vue';
import Jobs from './components/Jobs.vue';
import Job from './components/Job.vue';

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
            path: '/jobs/:id',
            name: 'job',
            component: Job
        },
        {
            path: '/failed-jobs',
            name: 'failed-jobs',
            component: FailedJobs
        },
        {
            path: '/failed-jobs/:id',
            name: 'failed-job',
            component: FailedJob
        }
    ]
});

export default router;
