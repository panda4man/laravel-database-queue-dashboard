<template>
    <div>
        <h1>Dashboard</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
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
</template>

<script>
    export default {
        data() {
            return {
                queues: []
            }
        },
        mounted() {
            this.getQueueStats();

            this.$nextTick(() => {
                this.$Echo
                    .channel('queues')
                    .listen('.cache-updated', (e) => {
                        console.log('.cache-updated');
                        console.log(e);
                    });
            });
        },
        destroyed() {
            this.$Echo.leave('queue');
        },
        methods: {
            getQueueStats() {
                this.$http.get('/api/queues').then(res => {
                    this.queues = res.data.data;
                }).catch(res => {
                    console.log(res);
                });
            }
        }
    }
</script>