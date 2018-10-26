<template>
    <div class="columns">
        <div class="column">
            <div class="card mb-lg">
                <header class="card-header">
                    <p class="card-header-title">
                        Overview
                    </p>
                </header>
                <div class="card-content">
                    <nav class="level">
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="header">Queues</p>
                                <p class="title" v-if="!http.queue_stats">{{ queues.length }}</p>
                                <font-awesome-icon icon="spinner" spin v-else></font-awesome-icon>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="header">Jobs</p>
                                <p class="title" v-if="!http.queue_stats">{{ totalJobs }}</p>
                                <font-awesome-icon icon="spinner" spin v-else></font-awesome-icon>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="header">Failed Jobs</p>
                                <p class="title" v-if="!http.queue_stats"> {{ totalFailedJobs }} </p>
                                <font-awesome-icon icon="spinner" spin v-else></font-awesome-icon>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="header">Failed Last Hour</p>
                                <p class="title" v-if="!http.failed_stats"> {{ failed_stats.count }} </p>
                                <font-awesome-icon icon="spinner" spin v-else></font-awesome-icon>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="card mb-lg">
                <header class="card-header">
                    <p class="card-header-title">
                        <font-awesome-icon icon="spinner" spin v-if="http.queue_stats"></font-awesome-icon>&nbsp;&nbsp;Queues
                    </p>
                </header>
                <div class="card-content is-paddingless">
                    <table class="table is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Queued</th>
                            <th>Failed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="queue in queues">
                            <td>{{queue.name}}</td>
                            <td>{{queue.queued}}</td>
                            <td>{{queue.failed}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                http: {
                    queue_stats: false,
                    failed_stats: false
                },
                failed_stats: {
                    count: 0
                },
                queues: [],
                interval: null,
            }
        },
        created() {
            this.getInitialStateData();

            this.interval = setInterval(() => {
                this.getQueues();
                this.getFailedJobStats();
            }, 7 * 1000);
        },
        methods: {
            getInitialStateData() {
                this.getQueues();
                this.getFailedJobStats();
            },
            getQueues() {
                this.http.queue_stats = true;

                this.$http.get('/api/queues').then(res => {
                    this.queues = res.data.data;
                }).catch(res => {
                    console.log(res);
                }).finally(() => {
                    this.http.queue_stats = false;
                });
            },
            getFailedJobStats() {
                this.http.failed_stats = true;

                this.$http.get('/api/failed-job-stats').then(res => {
                    console.log(res.data);
                    this.failed_stats.count = res.data.data.failed_count;
                }).catch(res => {
                    console.log(res.response);
                }).finally(() => {
                    this.http.failed_stats = false;
                });
            }
        },
        computed: {
            totalJobs() {
                return this.queues.reduce((total, queue) => {
                    return total + queue.queued;
                }, 0);
            },
            totalFailedJobs() {
                return this.queues.reduce((total, queue) => {
                    return total + queue.failed;
                }, 0);
            }
        }
    }
</script>