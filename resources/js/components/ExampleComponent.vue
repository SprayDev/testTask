<template>
    <div class="container">
        <div class="form-group" style="width: 30em">
            <v-select :options="items" class="form-control"></v-select>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    import "vue-select/dist/vue-select.css";
    export default {
        components: {vSelect},
        mounted() {
            console.log(this.items);
        },
        data(){
            return{
                items: [{name: 'Красноярск', id: 1}, {name: 'Казань', id: 2}, {name: 'Москва', id: 3}],
                city: 'Moscow',
                options: ['foo','bar','baz'],
                selected: null
            }
        }
    }
</script>
