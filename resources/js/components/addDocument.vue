<template>
    <form>
        <div class="row mobile-row">
            <div class="col-6 mobile-col">
                <fieldset class="exdel-fieldset">
                    <legend class="exdel-legend">Отправитель</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="outTemplate">Выбрать по</label>
                                    <vue-select id="outTemplate" class="style-chooser" v-model="outTemp" :options="temps" :reduce="template => template.id" label="template" placeholder="Выберете Шаблон"></vue-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="outFio">ФИО</label>
                                <input v-model="outFio" id="outFio" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outPartner">Организация</label>
                                <input v-model="outPartner" id="outPartner" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outPhone">Телефон</label>
                                <input v-model="outPhone" id="outPhone" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="outCity">Город</label>
                                <vue-select id="outCity" class="style-chooser" v-model="outCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете Город"></vue-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="outCountry">Страна</label>
                                <input v-model="outCountry" id="outCountry" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outReg">Регион/область</label>
                                <input v-model="outReg" id="outReg" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="outZIP">Индекс</label>
                                <input v-model="outZIP" id="outZIP" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outAddress">Адрес</label>
                                <input v-model="outAddress" id="outAddress" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6 mobile-col">
                <fieldset class="exdel-fieldset">
                    <legend class="exdel-legend">Получатель</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inTemplate">Выбрать по</label>
                                    <vue-select id="inTemplate" class="style-chooser" v-model="inTemp" :options="temps" :reduce="template => template.id" label="template" placeholder="Выберете Шаблон"></vue-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inFio">ФИО</label>
                                <input v-model="inFio" id="inFio" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inPartner">Организация</label>
                                <input v-model="inPartner" id="inPartner" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inPhone">Телефон</label>
                                <input v-model="inPhone" id="inPhone" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inCity">Город</label>
                                <vue-select id="inCity" class="style-chooser" v-model="inCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете Город"></vue-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inCountry">Страна</label>
                                <input v-model="inCountry" id="inCountry" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inReg">Регион/область</label>
                                <input v-model="inReg" id="inReg" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="inZIP">Индекс</label>
                                <input v-model="inZIP" id="inZIP" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inAddress">Адрес</label>
                                <input v-model="inAddress" id="inAddress" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row mobile-row">
            <div class="col-6 mobile-col">
                <fieldset class="exdel-fieldset">
                    <legend class="exdel-legend">Информация</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <label for="place">Количество мест</label>
                                <input v-model="place" id="place" class="form-control exdel-input" type="number" min="1">
                            </div>
                            <div class="col">
                                <label for="ves">Общий вес, кг</label>
                                <input v-model="ves" id="ves" class="form-control exdel-input" type="number" min="0.5">
                            </div>
                            <div class="col">
                                <label for="gab">Количество габаритных мест</label>
                                <input @change="addGab" v-model="gabs" id="gab" class="form-control exdel-input" type="number" min="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span>Габариты</span>
                                <div class="row" v-for="n in gabarits">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Длина</label>
                                            <input v-model="n.length" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Ширина</label>
                                            <input v-model="n.width" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Высота</label>
                                            <input v-model="n.height" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="typePack">Тип посылки</label>
                                <select id="typePack" class="form-control exdel-input" v-model="typePack">
                                    <option value="1">Документы</option>
                                    <option value="0">Не документы</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="payType">Расчет</label>
                                <select id="payType" class="form-control exdel-input" v-model="payType">
                                    <option value="1">По счету</option>
                                    <option value="0">Наличными</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="condition">Условия</label>
                                <select id="condition" class="form-control exdel-input" v-model="condition">
                                    <option value="1">По адресу</option>
                                    <option value="0">До востребования</option>
                                    <option value="2">Лично в руки</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="payer">Плательщик</label>
                                <select id="payer" class="form-control exdel-input" v-model="payer">
                                    <option value="1">Отправитель</option>
                                    <option value="0">Получатель</option>
                                    <option value="2">Служебное</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="note">Специнструкция</label>
                                <input id="note" class="form-control exdel-input" v-model="note" type="text">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6 mobile-col">
                <a v-if="!saving" @click="saveDoc" class="btn btn-outline-exdel my-2 my-sm-0">Сохранить накладную</a>
                <b-button v-else variant="primary" disabled>
                    <b-spinner small type="grow"></b-spinner>
                    Отправка письма
                </b-button>
            </div>
        </div>
    </form>
</template>

<script>
    import vueSelect from 'vue-select';
    import "vue-select/dist/vue-select.css";

    export default {
        name: "addDocument",
        props: ['cities', 'temps'],
        components: {vueSelect},
        data(){
            return {
                saving: false,
                note: '',
                typePack: '',
                payType: '',
                payer: '',
                condition: '',
                outTemp: 0,
                outPhone: '',
                outFio: '',
                outPartner: '',
                outCountry: '',
                outReg: '',
                outCity: 0,
                outAddress: '',
                outZIP: '',
                inTemp: 0,
                inPhone: '',
                inFio: '',
                inPartner: '',
                inCountry: '',
                inReg: '',
                inCity: 0,
                inAddress: '',
                inZIP: '',
                place: 1,
                ves: 0.5,
                gabs: 1,
                gabarits: [{length: 0, width: 0, height: 0}]
            }
        },
        mounted() {

        },
        methods:{
            addGab(){
                this.gabarits = [];
                for (let i = 0; i < this.gabs; i++)
                {
                    this.gabarits.push({length: 0, width: 0, height: 0});
                }
            },
            saveDoc(){
                this.saving = true;
                axios.put('/document/add',{
                        outFIO: this.outFio,
                        outPartner: this.outPartner,
                        outPhone: this.outPhone,
                        outCity: this.outCity,
                        outAddress: this.outAddress,
                        outZIP: this.outZIP,
                        inFIO: this.inFio,
                        inPartner: this.inPartner,
                        inPhone: this.inPhone,
                        inCity: this.inCity,
                        inAddress: this.inAddress,
                        inZIP: this.inZIP,
                        note: this.note,
                        typePack: this.typePack,
                        payType: this.payType,
                        payer: this.payer,
                        condition: this.condition,
                        ves: this.ves,
                        place: this.place,
                        gabarits: this.gabarits
                }).then((response)=>{
                    this.saving = false;
                    console.log(response.data);
                    //location.href = window.location+"document/print/"+response.data;
                });
            }
        },
        watch: {
            outTemp: function () {
                if (this.outTemp){
                    var temps = this.temps;
                    var tempId = this.outTemp;
                    var temp = temps.filter(function(val) {
                        return val.id === tempId;
                    })[0];
                    this.outPhone = temp.phone;
                    this.outPartner = temp.partner;
                    this.outZIP = temp.zip;
                    this.outAddress = temp.address;
                    this.outCity = temp.city;
                }
                else{
                    this.outPhone = '';
                    this.outPartner = '';
                    this.outZIP = '';
                    this.outAddress = '';
                    this.outCity = 0;
                }
            },
            inTemp: function () {
                if (this.inTemp){
                    var temps = this.temps;
                    var tempId = this.inTemp;
                    var temp = temps.filter(function(val) {
                        return val.id === tempId;
                    })[0];
                    this.inPhone = temp.phone;
                    this.inPartner = temp.partner;
                    this.inZIP = temp.zip;
                    this.inAddress = temp.address;
                    this.inCity = temp.city;
                }
                else {
                    this.inPhone = '';
                    this.inPartner = '';
                    this.inZIP = '';
                    this.inAddress = '';
                    this.inCity = 0;
                }
            },
            outCity: function () {
                if (this.outCity){
                    var cities = this.cities;
                    var cityId = this.outCity;
                    var city = cities.filter(function (val) {
                        return val.id === cityId;
                    })[0];
                    this.outReg = city.region;
                    this.outCountry = city.country;
                }
                else {
                    this.outReg = '';
                    this.outCountry = '';
                }
            },
            inCity: function () {
                if (this.inCity){
                    var cities = this.cities;
                    var cityId = this.inCity;
                    var city = cities.filter(function (val) {
                        return val.id === cityId;
                    })[0];
                    this.inReg = city.region;
                    this.inCountry = city.country;
                }
                else {
                    this.inReg = '';
                    this.inCountry = '';
                }
            }
        }
    }
</script>

<style scoped>

</style>
