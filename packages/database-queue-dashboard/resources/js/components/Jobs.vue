<template>
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <font-awesome-icon icon="spinner" spin v-if="http.jobs"></font-awesome-icon>&nbsp;&nbsp;Recent Jobs
                    </p>
                </header>
                <div class="card-content is-paddingless">
                    <table class="table is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Job</th>
                            <th>On</th>
                            <th>Attempts</th>
                            <th>Reserved At</th>
                            <th>Available At</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="job in jobs" class="clickable" @click="goToJob(job.id)">
                            <td>{{ job.id }}</td>
                            <td>{{ job.payload.displayName }}</td>
                            <td>{{ job.queue }}</td>
                            <td>{{ job.attempts }}</td>
                            <td>{{ job.reserved_at }}</td>
                            <td>{{ job.available_at }}</td>
                            <td>{{ job.created_at }}</td>
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
                    jobs: false
                },
                jobs: [],
                interval: null
            }
        },
        created() {
            this.getJobs();

            this.interval = setInterval(this.getJobs, 10 * 1000);
        },
        beforeDestroy() {
            clearInterval(this.interval);
        },
        methods: {
            getJobs() {
                this.http.jobs = true;

                this.$http.get(`/api/jobs`).then(res => {
                    this.jobs = res.data.data;
                }).catch(res => {
                    console.log(res.response);
                }).finally(() => {
                    this.http.jobs = false;
                });
            },
            goToJob(id = 0) {
                this.$router.push({ name: 'job', params: {id} });
            }
        }
    }
</script>