<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-full-mobile is-4-tablet is-2-desktop">
                    <aside class="menu">
                        <ul class="menu-list">
                            <li><router-link :to="{ name: 'dashboard' }">Overview</router-link></li>
                            <li><router-link :to="{ name: 'failed-jobs' }">Failed Jobs</router-link></li>
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
        name: 'DatabaseQueueDashboard'
    }
</script>