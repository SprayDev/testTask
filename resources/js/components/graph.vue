<template>
    <div class="small">
        <line-chart :chart-data="data" :height="300" :options="{responsive: true, maintainAspectRatio: true}"></line-chart>
    </div>
</template>

<script>
    import LineChart from "./LineChart";

    export default {
        components: {
            LineChart
        },
        name: 'graph',
        data(){
            return {
                data: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update(){
                axios.get('/api/get/data').then( (response) => {
                    console.log(response.data)
                    this.data = response.data;
                })
            }
        }
    }
</script>

<style>
    .small {
        max-width: 600px;
        margin:  150px auto;
    }
</style>
