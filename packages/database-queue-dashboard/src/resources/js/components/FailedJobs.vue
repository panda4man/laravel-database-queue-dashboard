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
                            <form @submit.prevent="runSearch" class="mr-sm">
                                <div class="field is-horizontal">
                                    <div class="control">
                                        <input type="text" v-model="search.queue" class="input is-primary" placeholder="Filter by queue">
                                    </div>
                                </div>
                            </form>
                            <button @click="runSearch" class="button is-primary">Search</button>
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
                        <tr v-for="job in failed_jobs" class="clickable" @click="goToJob(job.id)">
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
                                <a class="pagination-link" :class="{'is-current': page.current}" v-on:click="getPageResults(page.page)">
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
                search: {
                    queue: '',
                    page: null
                }
            }
        },
        created() {
            this.runSearch();
        },
        methods: {
            runSearch() {
                this.search.page = 1;
                
                this.getFailedJobs(this.search);
            },
            getPageResults(page = 0) {
                this.search.page = page;

                this.getFailedJobs(this.search);
            },
            getFailedJobs(params = {}) {
                if(this.http.failed_jobs) {
                    return;
                }

                let url = "/api/failed-jobs" + '?' + this.buildQueryString(params);
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
            },
            buildQueryString(params = {}) {
                let parameters = [];
                for(let k in params) {
                    if(!params.hasOwnProperty(k)) {
                        continue;
                    }

                    if(!params[k]) {
                        continue;
                    }

                    const value = params[k];

                    if(k === 'queue') {
                        k = 'filter[queue]';
                    }

                    parameters.push(`${k}=${value}`);
                }

                return parameters.join('&');
            }
        }
    }
</script>