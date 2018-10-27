<template>
    <div>
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li><a @click="$router.go(-1)">Jobs</a></li>
                <li class="is-active"><a href="#" aria-current="page">Details</a></li>
            </ul>
        </nav>
        <div class="columns">
            <div class="column">
                <div class="card">
                    <template v-if="http.job">
                        <div class="notification is-primary">
                            Fetching the data for this job...
                        </div>
                    </template>
                    <template v-else>
                        <template v-if="errors.job">
                            <div class="notification is-danger">
                                <div class="mb-md">
                                    An error occurred trying to fetch the data for this failed job.
                                </div>
                                <button @click="retry" class="button">Retry</button>
                            </div>
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
                                            <div class="header">Created At</div>
                                            <div class="title">{{ job.created_at }}</div>
                                        </div>
                                    </div>
                                </nav>
                                <hr>
                                <div class="columns">
                                    <div class="column">
                                        <div class="job-payload">
                                            <pre>{{ job.payload }}</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                job_id: null,
                http: {
                    job: false
                },
                job: null,
                errors: {
                    job: null
                }
            }
        },
        created() {
            this.job_id = this.$route.params.id;
            this.getJob(this.job_id);
        },
        methods: {
            retry() {
                this.getJob(this.job_id);
            },
            getJob(id = 0) {
                this.http.job = true;
                this.errors.job = null;

                this.$http.get(`/api/jobs/${id}`).then(res => {
                    this.job = res.data.data;
                }).catch(res => {
                    if(res.response) {
                        this.errors.job = res.response.data.data;
                    } else {
                        this.errors.job = "Unknown error occurred";
                    }
                }).finally(() => {
                    this.http.job = false;
                });
            }
        }
    }
</script>