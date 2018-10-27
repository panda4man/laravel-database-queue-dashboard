<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-full-mobile is-4-tablet is-2-desktop">
                    <aside class="menu">
                        <ul class="menu-list">
                            <li>
                                <router-link active-class="is-active" :to="{ name: 'dashboard' }" exact>
                                    <font-awesome-icon icon="chart-bar"></font-awesome-icon>&nbsp;&nbsp;Overview
                                </router-link>
                            </li>
                            <li>
                                <router-link active-class="is-active" :to="{ name: 'jobs' }">
                                    <font-awesome-icon icon="clock"></font-awesome-icon>&nbsp;&nbsp;Recent Jobs
                                </router-link>
                            </li>
                            <li>

                                <router-link active-class="is-active" :to="{ name: 'failed-jobs' }">
                                    <font-awesome-icon icon="th-list"></font-awesome-icon>&nbsp;&nbsp;Failed Jobs
                                </router-link>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="column">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'LaravelDatabaseQueueDashboard'
    }
</script>