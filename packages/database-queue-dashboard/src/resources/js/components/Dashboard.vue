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
                                <p class="header">Jobs</p>
                                <p class="title">{{ totalJobs }}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="header">Failed Jobs</p>
                                <p class="title"> {{ totalFailedJobs }} </p>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="card mb-lg">
                <header class="card-header">
                    <p class="card-header-title">
                        Queues
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
                queues: [],
                interval: null
            }
        },
        created() {
            this.getQueueStats();

            this.interval = setInterval(this.getQueueStats, 7*1000);
        },
        methods: {
            getQueueStats() {
                this.$http.get('/api/queues').then(res => {
                    this.queues = res.data.data;
                }).catch(res => {
                    console.log(res);
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