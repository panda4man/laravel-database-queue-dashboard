<template>
    <div class="columns">
        <div class="column">
            <div class="card">
                <template v-if="http.job">

                </template>
                <template v-else>
                    <header class="card-header">
                        <p class="card-header-title">{{ job.payload.displayName }}</p>
                    </header>
                    <div class="card-content">
                        <nav class="level">
                            <div class="level-item has-text-centered">
                                <div>
                                    <div class="header">ID</div>
                                    <div class="title">{{ job.id }}</div>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <div class="header">Queue</div>
                                    <div class="title">{{ job.queue }}</div>
                                </div>
                            </div>
                            <div class="level-item has-text-centered">
                                <div>
                                    <div class="header">Failed At</div>
                                    <div class="title">{{ job.failed_at }}</div>
                                </div>
                            </div>
                        </nav>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="job-exception">
                                    <pre>{{ job.exception }}</pre>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="columns">
                            <div class="column">
                                <div class="job-exception">
                                    <pre>{{ job.payload }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        data() {
            return {
                job: null,
                http: {
                    job: false
                }
            }
        },
        created() {
            const id = this.$route.params.id;
            this.getJob(id);
        },
        methods: {
            getJob(id = 0) {
                this.http.job = true;

                this.$http.get(`/api/failed-jobs/${id}`).then(res => {
                    this.job = res.data.data;
                }).catch(res => {
                    console.log(res.response);
                }).finally(() => {
                    this.http.job = false;
                });
            }
        }
    }
</script>