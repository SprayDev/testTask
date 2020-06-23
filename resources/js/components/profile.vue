<template>
    <b-container>
        <b-row>
            <b-col>
                <span class="font-weight-bold profile-desc-span">Название организации: </span>
                <span class="profile-desc-span">{{ user.name }}</span>
            </b-col>
            <b-col>
                <button class="btn btn-outline-exdel" @click="callVK">Вызвать курьера</button>
            </b-col>
            <b-col cols="12"></b-col>
            <b-col>
                <span class="font-weight-bold profile-desc-span">Ваш менеджер: </span>
                <span class="profile-desc-span">{{ profile.manager }} ({{user.managerMail}})</span>
                <button @click="sendMessage" class="btn btn-outline-exdel"><i class="fa fa-envelope"></i></button>
            </b-col>
            <b-col class="d-inline-flex">
                    <b-form-group>
                        <div style="display: inline-flex">
                            <b-form-input
                                id="searchDateMin"
                                v-model="formPdf.searchDateMin"
                                type="text"
                                :state="validatePdf('searchDateMin')"
                                placeholder="Начало периода"
                                autocomplete="off"
                                class="form-control input-date"
                            ></b-form-input>
                            <b-form-datepicker button-only v-model="formPdf.searchDateMin"></b-form-datepicker>
                        </div>
                        <div class="pl-2 pr-2" style="display: inline-flex">
                            <b-form-input
                                id="searchDateMax"
                                v-model="formPdf.searchDateMax"
                                type="text"
                                placeholder="Конец периода"
                                autocomplete="off"
                                :state="validatePdf('searchDateMax')"
                                class="form-control input-date"
                            ></b-form-input>
                            <b-form-datepicker button-only v-model="formPdf.searchDateMax"></b-form-datepicker>
                        </div>
                    </b-form-group>
                    <b-form-group>
                        <button type="button" class="btn btn-outline-exdel" @click="balancePdf">Акт сверки</button>
                    </b-form-group>
            </b-col>
            <b-col cols="12"></b-col>
            <b-col>
                <span class="font-weight-bold profile-desc-span">Контактный телефон: </span>
                <span class="profile-desc-span">{{ profile.phone }}</span>
            </b-col>
            <b-col cols="12"></b-col>
            <b-col>
                <span class="font-weight-bold profile-desc-span">Ваш баланс: </span>
                <span class="profile-desc-span">{{ profile.balance }} руб.</span>
            </b-col>
            <b-col cols="12"></b-col>
            <b-col :cols="fileColls">
                <b-form-group>
                    <b-form-file
                        v-model="formFile.file"
                        :state="validateFile('file')"
                        placeholder="Выберете файл или перетащите сюда"
                        drop-placeholder="Перетащите файл сюда"
                        browse-text="загрузить"
                    ></b-form-file>
                </b-form-group>
                <button class="btn btn-outline-exdel" v-show="!loading" @click="upload">Загрузить накладные</button>
                <button class="btn btn-outline-exdel" v-show="loading" disabled>
                    <b-spinner small type="grow"></b-spinner>
                    Загрузка накладных в базу!
                </button>
            </b-col>
        </b-row>
        <b-modal
            v-model="show"
            title="Оформить вызов курьер"
            header-bg-variant="primary"
            header-text-variant="light"
            body-bg-variant="light"
            body-text-variant="dark"
            hide-footer
        >
            <b-overlay :show="showOver" rounded="sm">
                <b-container fluid>
                    <b-form>
                        <b-form-group
                            id="date"
                            label="Желаемая дата приезда курьера"
                            label-for="phone"
                        >
                            <div style="display: inline-flex">
                                <b-form-input
                                    id="date"
                                    name="date"
                                    :state="validateState('date')"
                                    v-model="form.date"
                                    type="text"
                                    placeholder="YYYY-MM-DD"
                                    autocomplete="off"
                                    class="form-control"
                                ></b-form-input>
                                <b-form-datepicker button-only v-model="form.date"></b-form-datepicker>
                            </div>
                        </b-form-group>
                        <b-form-group
                            id="city"
                            label="Где забрать"
                            label-for="city"
                        >
                            <b-form-input
                                id="city"
                                name="city"
                                v-model="form.city"
                                :state="validateState('city')"
                                type="text"
                                required
                                hidden
                                aria-describedby="city"
                            ></b-form-input>
                            <v-select name="city" class="style-chooser" v-model="form.city" :options="cities" :reduce="name => name.id" label="name" placeholder="Выберете город"></v-select>
                            <b-form-invalid-feedback
                                id="city"
                            >Выберете город!</b-form-invalid-feedback>
                        </b-form-group>
                        <b-form-group
                            id="address"
                            label-for="address"
                        >
                            <b-form-input
                                id="address"
                                name="address"
                                v-model="form.address"
                                :state="validateState('address')"
                                type="text"
                                placeholder="улица, дом, квартира или номер офиса"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="partner"
                            label-for="partner"
                        >
                            <b-form-input
                                id="partner"
                                v-model="form.partner"
                                :state="validateState('partner')"
                                type="text"
                                placeholder="Наименование отправителя"
                                name="partner"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="fio"
                            label-for="fio"
                        >
                            <b-form-input
                                id="fio"
                                v-model="form.fio"
                                name="fio"
                                placeholder="ФИО отправителя"
                                :state="validateState('fio')"
                                type="text"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="phone"
                            label=""
                            label-for="phone"
                        >
                            <b-form-input
                                id="phone"
                                v-model="form.phone"
                                :state="validateState('phone')"
                                name="phone"
                                type="text"
                                placeholder="Номер телефона отправителя"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="PhoneP"
                            label="Данные заказчика"
                            label-for="PhoneP"
                        >
                            <b-form-input
                                id="PhoneP"
                                v-model="form.phoneP"
                                type="text"
                                placeholder="Телефон клиента"
                                :state="validateState('phoneP')"
                                name="phoneP"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-form-group
                            id="fioP"
                            label-for="PhoneP"
                        >
                            <b-form-input
                                id="fioP"
                                v-model="form.fioP"
                                type="text"
                                placeholder="ФИО заказчика"
                                :state="validateState('fioP')"
                                name="phoneP"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <b-button @click="vkCreate" type="button" variant="primary">Отправить</b-button>
                    </b-form>
                </b-container>
            </b-overlay>
        </b-modal>
    </b-container>
</template>

<script>
    import { validationMixin } from "vuelidate";
    import { saveAs } from 'file-saver';
    import XLSX from 'xlsx';
    import h337 from 'heatmap.js';
    import vSelect from 'vue-select';
    import "vue-select/dist/vue-select.css";
    import { required, minLength, between } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        name: "profile",
        props: ['user', 'profile', 'cities', 'status'],
        components: {vSelect},
        data(){
            return {
                fileColls: 0,
                show: false,
                showOver: false,
                loading: false,
                form: {
                    phoneP: '',
                    partner: '',
                    fio: '',
                    date: '',
                    phone: '',
                    city: null,
                    address: '',
                    fioP: '',
                    userId: this.user.id
                },
                formPdf: {
                    searchDateMax: '',
                    searchDateMin: '',
                },
                formFile: {
                    file: null
                },
                clickCoordinates: {
                    clickX: 0,
                    clickY: 0,
                    clickTime: null
                }
            }
        },
        validations: {
            form: {
                phoneP: {
                    required
                },
                partner: {
                    required
                },
                fio: {
                    required
                },
                fioP: {
                    required
                },
                date: {
                    required
                },
                phone: {
                    required
                },
                city: {
                    required
                },
                address: {
                    required
                }
            },
            formFile: {
                file: {
                    required
                }
            },
            formPdf: {
                searchDateMax: {
                    required
                },
                searchDateMin: {
                    required
                }
            }
        },
        computed: {

        },
        ready: function () {
            window.beforeunload = this.leaving;
            window.onblur = this.leaving;
            //window.onmouseout = this.leaving;

        },
        mounted() {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
                this.fileColls = 12;
            } else this.fileColls = 4;
            console.log(this.fileColls)
            var $vm = this;
            var array = [];
            $('body').click(function (e) {
                var now = new Date();
                array.push({clickX: e.clientX, clickY: e.clientY, clickTime: now});
                $vm.clickCoordinates = array;
                array = [];
                axios.put('api/put/xyz', {
                    params:{
                        array: $vm.clickCoordinates
                    }
                }).then( (response) => {
                    console.log(response.data)
                }).catch(error => {
                    console.log(error);
                    this.errored = true;
                });
            });
        },
        methods:{
            leaving: function () {
                alert("Leaving...");
            },
            sendMessage(){
              location.href = '/message';
            },
            balancePdf(){
                this.$v.formPdf.$touch();
                if (this.$v.formPdf.$anyError) {
                    return;
                }
                window.open( window.location.href+'/balance/pdf?MinDate='+this.formPdf.searchDateMin+'&MaxDate='+this.formPdf.searchDateMax);
            },
            upload(){
                var user = this.user;
                this.$v.formFile.$touch();
                if (this.$v.formFile.$anyError) {
                    return;
                }
                var reader = new FileReader();
                reader.readAsBinaryString(this.formFile.file);
                this.loading = true;

                reader.onload = function() {
                    var data = reader.result;
                    var workbook = XLSX.read(data, {
                        type:'binary',
                        cellDates:true,
                        cellNF: false,
                        cellText:false
                    });
                    var ws = workbook.Sheets[workbook.SheetNames[0]];
                    var success = true;
                    var documents = XLSX.utils.sheet_to_json(ws, {dateNF:"YYYY-MM-DD", header: 1});
                    documents.splice(0, 1);
                    documents.forEach((doc) => {
                       var place = doc[5];
                       if (!Number.isInteger(place)){
                           alert("Ошибка в файле! Проверьте колонку 'Мест', это поле должно принимать только целое значение");
                           success = false;
                       }
                       var ves = doc[6];
                        if (!Number.isFinite(ves)){
                            alert("Ошибка в файле! Проверьте колонку 'Вес', это поле должно содержать только числа");
                            success = false
                        }
                    });
                    if (success === true){
                        documents.forEach((doc) => {
                            axios.put('api/excel/load',{
                                params:{
                                    doc: doc,
                                    user: user.id
                                }
                            }).then((response) => {
                               console.log(response.data)
                            });
                        });

                        alert("Файл успешно загружен");
                    }
                };
                this.loading = false;

            },
            callVK(){
                this.show = true;
            },
            vkCreate(){

                this.$v.form.$touch();
                if (this.$v.form.$anyError) {
                    return;
                }
                this.showOver = true;
                axios.put('api/vk/create', {
                    params: {
                        form: this.form
                    }
                }).then((response) => {
                    this.form = {
                        phoneP: '',
                        partner: '',
                        fio: '',
                        date: '',
                        phone: '',
                        city: null,
                        address: '',
                        userId: this.user.id
                    };
                    this.$v.$reset();
                    this.showOver = false;
                    this.show = false;
                });
            },
            validateState(name) {
                const { $dirty, $error } = this.$v.form[name];
                return $dirty ? !$error : null;
            },
            validatePdf(name) {
                const { $dirty, $error } = this.$v.formPdf[name];
                return $dirty ? !$error : null;
            },
            validateFile(name) {
                const { $dirty, $error } = this.$v.formFile[name];
                return $dirty ? !$error : null;
            }
        }
    }
</script>

<style scoped>

</style>
