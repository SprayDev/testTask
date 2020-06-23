<template>
    <form>
        <div class="row mobile-row">
            <div class="col-6 mobile-col">
                <fieldset class="exdel-fieldset">
                    <legend class="exdel-legend">Отправитель</legend>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <label for="outFio">ФИО</label>
                                <input disabled v-model="outFio" id="outFio" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outPartner">Организация</label>
                                <input disabled v-model="outPartner" id="outPartner" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outPhone">Телефон</label>
                                <input disabled v-model="outPhone" id="outPhone" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="outCity">Город</label>
                                <vue-select disabled="" id="outCity" class="style-chooser" v-model="outCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете Город"></vue-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="outCountry">Страна</label>
                                <input disabled v-model="outCountry" id="outCountry" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outReg">Регион/область</label>
                                <input disabled v-model="outReg" id="outReg" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="outZIP">Индекс</label>
                                <input disabled v-model="outZIP" id="outZIP" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="outAddress">Адрес</label>
                                <input disabled v-model="outAddress" id="outAddress" class="form-control exdel-input" type="text">
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
                                <label for="inFio">ФИО</label>
                                <input disabled v-model="inFio" id="inFio" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inPartner">Организация</label>
                                <input disabled v-model="inPartner" id="inPartner" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inPhone">Телефон</label>
                                <input disabled v-model="inPhone" id="inPhone" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inCity">Город</label>
                                <vue-select disabled="" id="inCity" class="style-chooser" v-model="inCity" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете Город"></vue-select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inCountry">Страна</label>
                                <input disabled v-model="inCountry" id="inCountry" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inReg">Регион/область</label>
                                <input disabled v-model="inReg" id="inReg" class="form-control exdel-input" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="inZIP">Индекс</label>
                                <input disabled v-model="inZIP" id="inZIP" class="form-control exdel-input" type="text">
                            </div>
                            <div class="col">
                                <label for="inAddress">Адрес</label>
                                <input disabled v-model="inAddress" id="inAddress" class="form-control exdel-input" type="text">
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
                                <input disabled v-model="place" id="place" class="form-control exdel-input" type="number" min="1">
                            </div>
                            <div class="col">
                                <label for="ves">Общий вес, кг</label>
                                <input disabled v-model="ves" id="ves" class="form-control exdel-input" type="number" min="0.5">
                            </div>
                            <div class="col">
                                <label for="gab">Количество габаритных мест</label>
                                <input disabled v-model="gabs" id="gab" class="form-control exdel-input" type="number" min="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span>Габариты</span>
                                <div class="row" v-for="n in gabarits">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Длина</label>
                                            <input disabled v-model="n.length" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Ширина</label>
                                            <input disabled v-model="n.width" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Высота</label>
                                            <input disabled v-model="n.height" class="form-control exdel-input gab">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="typePack">Тип посылки</label>
                                <select disabled id="typePack" class="form-control exdel-input" v-model="typePack">
                                    <option value="1">Документы</option>
                                    <option value="0">Не документы</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="payType">Расчет</label>
                                <select disabled id="payType" class="form-control exdel-input" v-model="payType">
                                    <option value="1">По счету</option>
                                    <option value="0">Наличными</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="condition">Условия</label>
                                <select disabled id="condition" class="form-control exdel-input" v-model="condition">
                                    <option value="1">По адресу</option>
                                    <option value="2">До востребования</option>
                                    <option value="0">Лично в руки</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="payer">Плательщик</label>
                                <select disabled id="payer" class="form-control exdel-input" v-model="payer">
                                    <option value="0">Отправитель</option>
                                    <option value="1">Получатель</option>
                                    <option value="2">Служебное</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="note">Специнструкция</label>
                                <input disabled id="note" class="form-control exdel-input" v-model="note" type="text">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-6 mobile-col">
                <h1>Накладная № {{doc.number}}</h1>
            </div>
        </div>
    </form>
</template>

<script>
    import vueSelect from 'vue-select';
    import "vue-select/dist/vue-select.css";

    export default {
        name: "getDocument",
        props: ['doc', 'cities'],
        components: {vueSelect},
        data(){
            return {
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
            this.note = this.doc.note;
            this.outFio = this.doc.outFIO;
            this.outPartner = this.doc.outPartner;
            this.outPhone = this.doc.outPhone;
            this.outCity = this.doc.outCity;
            this.outAddress = this.doc.outAddress;
            this.inPhone = this.doc.inPhone;
            this.inFio = this.doc.inFIO;
            this.inPartner = this.doc.inPartner;
            this.inCity = this.doc.inCity;
            this.inAddress = this.doc.inAddress;
            this.inZIP = this.doc.inZIP;
            this.place = this.doc.place;
            this.ves = this.doc.ves;
            this.condition = this.doc.condition;
            this.payer = this.doc.payRcv;
            this.payType = this.doc.payType;
            this.typePack = this.doc.typePack;
            console.log(this.doc);
        },
        watch: {
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
