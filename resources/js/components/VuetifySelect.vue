<template>
    <v-select
        :items="items"
        item-text="name"
        item-value="id"
        label="Город"
        outlined
    ></v-select>
</template>

<script>
   export default {
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

<style scoped>

</style>
