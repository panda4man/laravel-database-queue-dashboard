<template>
    <div>
        <h1>Database Queues</h1>
        <div class="sidebar">
            <ul>
                <li><router-link :to="{ name: 'dashboard' }">Overview</router-link></li>
                <li><router-link :to="{ name: 'jobs' }">Jobs</router-link></li>
                <li><router-link :to="{ name: 'failed-jobs' }">Failed Jobs</router-link></li>
            </ul>
        </div>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'DatabaseQueueDashboard'
    }
</script>