<template>
    <div>
        <div>
            <b-form>
                <b-form-group label="Статус" label-for="status">
                    <b-form-select id="status" v-model="selected" :options="options" ></b-form-select>
                </b-form-group>
                <b-form-group label="ФИО" label-for="fio">
                    <b-form-input id="fio" v-model="text" placeholder="ФИО"></b-form-input>
                </b-form-group>
            </b-form>
            <div v-if="selected.id>0" class="mt-3"><strong>{{ selected.name + ', ' + text}}</strong></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tabtest",
        data() {
            return {
                selected: [
                    {id: 0, name: 'Не выбран'}
                ],
                text: '',
                options: [
                    { value: {id: 0, name: ''}, text: 'Выберете статус' },
                    { value: {id: 1, name: 'Частично выполнен' }, text: 'Частично выполнен' },
                    { value: {id: 2, name: 'Полностью выполнен' }, text: 'Полностью выполнен' },
                    { value: {id: 3, name: 'Доставлен' }, text: 'Доставлен' }
                ]
            }
        },
        mounted() {
            if (this.selected.id === 0 || this.selected.id === 1)
                console.log('test')
        }
    }
</script>

<style scoped>

</style>
