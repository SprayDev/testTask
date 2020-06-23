<template>
    <div class="container">
        <v-style>
            .smooth-enter-to, .smooth-leave {
            height: {{computedHeight}};
            }
        </v-style>
        <div class="text-center pr-4 pl-4">
            <h1 class="font-weight-bolder">РАСЧЕТ СТОИМОСТИ ГРУЗО­ПЕРЕВОЗКИ</h1>
            <p class="font-weight-bold" align="justify">Реалии современной жизни заставляют нас быть мобильными. Успевать везде и всюду, делать сто тысяч дел одновременно. Часто возникает необходимость отправки груза, которую нужно одинаково быстро осуществить, независимо от его формата – малого, среднего, крупного. Такие заказы пользуются популярностью у всех: от компаний разной величины до частных заказчиков.</p>
            <p class="font-weight-bold" align="justify">Обратившись к нам, вы можете быть уверены, что ваш груз будет доставлен точно в срок, в целости и сохранности. К тому же, это так удобно! Вам не нужно беспокоиться о расчётах и выявлении самого экономичного способа перевозки. Эту и все последующие задачи мы берём на себя.</p>
            <p class="font-weight-bold" align="justify">Мы позаботились о каждом моменте, который может вызвать у вас вопрос. Например, во сколько мне обойдётся перевозка груза X из пункта K. в пункт N.? Воспользовавшись нашим калькулятором стоимости перевозки груза, вы за пару минут узнаете точную сумму.</p>
        </div>
        <div class="calculator">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Откуда</label>
                        <v-select class="style-chooser" v-model="outCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете город"></v-select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Куда</label>
                        <v-select class="style-chooser" v-model="inCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете город"></v-select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Вес, кг</label>
                        <input class="form-control input-ves" type="number" v-model="ves">
                    </div>
                    <div class="form-group col-md float-right">
                        <button class="btn btn-outline-exdel btn-calc my-2 my-sm-0" @click="calc" type="button">Рассчитать</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col">
                    <a @click="showSize=!showSize" class="btn btn-outline-exdel btn-calc my-2 my-sm-0">Габариты</a>
                </div>
            </div>
            <template v-if="showSize">
                <div class="row">
                    <div class="col">
                        <span>Габариты</span>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Длина</label>
                                    <input v-model="length" class="form-control exdel-input gab">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Ширина</label>
                                    <input v-model="width" class="form-control exdel-input gab">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Высота</label>
                                    <input v-model="height" class="form-control exdel-input gab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <transition name="smooth">
                <div class="row text-center" ref="myText" v-show="show">
                    <h1>Итого: {{this.total}} руб.</h1>
                </div>
            </transition>
            <!--<transition name="smooth">
                <div class="row" ref="myText" v-show="show">
                    <table class="table">
                        <thead class="thead-dark thead-exdel">
                        <tr>
                            <th>Тариф</th>
                            <th>Срок</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tr v-for="tariff in tariffs">
                            <td>{{tariff.Name}}</td>
                            <td>{{tariff.Srok}}</td>
                            <td>{{tariff.Price}} руб.</td>
                        </tr>
                    </table>
                </div>
            </transition>-->
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    import "vue-select/dist/vue-select.css";
    Vue.component('v-style', {
        render: function (createElement) {
            return createElement('style', this.$slots.default)
        }
    });
    export default {
        name: "caclulator",
        components: {vSelect},
        props: ['cities', 'user'],
        data(){
            return{
                computedHeight: 'auto',
                outCity: 18042,
                inCity: 17366,
                ves: 0.5,
                show: false,
                showSize: false,
                length: 0,
                height: 0,
                width: 0,
                total: 0,
                tariffs: [
                    {Name: "test1", Srok: 1, Price: 0},
                    {Name: "test2", Srok: 1, Price: 0},
                    {Name: "test3", Srok: 1, Price: 0},
                    {Name: "test5", Srok: 1, Price: 0},
                    {Name: "test4", Srok: 1, Price: 0}
                    ]
            }
        },
        methods:{
            calc: function () {
                axios.get('/api/calculate', {
                    params:{
                        ves: this.ves,
                        inCity: this.inCity,
                        outCity: this.outCity,
                        ox: this.length,
                        oy: this.width,
                        oz: this.height,
                        user: this.user
                    }
                }).then((response)=>{
                    //this.tariffs = response.data;
                    this.total = response.data;
                    this.show = !this.show
                    console.log(response);
                });
            },
            initHeight: function(){
                this.$refs['myText'].style.position = 'absolute';
                this.$refs['myText'].style.visibility = 'hidden';
                this.$refs['myText'].style.display = 'block';

                const height = getComputedStyle(this.$refs['myText']).height;

                this.computedHeight= height;

                this.$refs['myText'].style.position = null;
                this.$refs['myText'].style.visibility = null;
                this.$refs['myText'].style.display = 'none';

            }
        },
        mounted() {
            this.initHeight()
            console.log(this.user);
        }
    }
</script>

<style scoped>
    .smooth-enter-active, .smooth-leave-active {
        transition: height .9s;
        overflow: hidden;
    }
    .smooth-enter, .smooth-leave-to {
        height: 0;
    }

</style>
