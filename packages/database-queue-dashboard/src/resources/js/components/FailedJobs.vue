<template>
    <div class="columns">
        <div class="column">
            <div class="card">
                <header class="card-header">
                    <nav class="level">
                        <div class="level-item level-left">
                            <p class="card-header-title">
                                Failed Jobs
                            </p>
                        </div>
                        <div class="level-item level-right">
                            <form>
                                <div class="field">
                                    <div class="control">
                                        <input type="text" class="input is-primary" placeholder="Filter by queue">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </nav>
                </header>
                <div class="card-content is-paddingless">
                    <table class="table is-hoverable is-fullwidth">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Job</th>
                            <th>On</th>
                            <th>Failed At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="job in failed_jobs" class="clickable" v-on:click="goToJob(job.id)">
                            <td>{{ job.id }}</td>
                            <td>{{ job.payload.displayName }}</td>
                            <td>{{ job.queue }}</td>
                            <td>{{ job.failed_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                        <ul class="pagination-list">
                            <li v-for="page in pagination.window">
                                <a class="pagination-link" :class="{'is-current': page.current}" v-on:click="getPage(page.page)">
                                    {{ page.page }}
                                </a>
                            </li>
                        </ul>
                    </nav>
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
                    failed_jobs: false
                },
                failed_jobs: [],
                pagination: {
                    window: []
                },
                queue: ''
            }
        },
        created() {
            this.getFailedJobs();
        },
        methods: {
            getPage(page = 0) {
                const queue = this.queue;
                let search = {
                    page,
                    queue
                };

                this.getFailedJobs(search);
            },
            getFailedJobs(params = {}) {
                console.log(params);
                let url = "/api/failed-jobs";
                let parameters = [];

                for(let k in params) {
                    if(!params.hasOwnProperty(k)) {
                        continue;
                    }

                    if(!params[k]) {
                        continue;
                    }

                    if(k === 'queue') {
                        k = 'filter[queue]';
                    }
                    parameters.push(`${k}=${params[k]}`);
                }

                url += '?' + parameters.join('&');
                console.log(url);

                this.http.failed_jobs = true;

                this.$http.get(url).then(res => {
                    this.failed_jobs = res.data.data;
                    console.log(res.data);

                    this.buildPaginationWindow(res.data.meta);
                }).catch(res => {
                    console.log(res.response);
                }).finally(() => {
                    this.http.failed_jobs = false;
                });
            },
            goToJob(id = 0) {
                this.$router.push({name: 'failed-job', params: {id}});
            },
            buildPaginationWindow(meta = {}) {
                const current = meta.current_page;
                const last_page = meta.last_page;
                const start = current - 2;
                const stop = current + 2;
                this.pagination.window = [];

                for (let i = start; i <= stop; i++) {
                    if(i < 1 || i > last_page) {
                        continue;
                    }
                    this.pagination.window.push({
                        page: i,
                        current: (current === i)
                    });
                }
            }
        }
    }
</script>