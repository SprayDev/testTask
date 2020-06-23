<template>
    <b-container class="mw-50">
        <b-form>
            <b-form-group
                id="phone"
                label="Ваш номер телефона:"
                label-for="phoneForm"
            >
                <b-form-input
                    id="phoneForm"
                    v-model="form.phone"
                    type="text"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                id="email"
                label="Ваш почтовый ящик:"
                label-for="email"
            >
                <b-form-input
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-2" label="Тема сообщения" label-for="subject">
                <b-form-input
                    id="subject"
                    v-model="form.subject"
                    required
                    placeholder="Тема"
                ></b-form-input>
            </b-form-group>
            <b-form-group id="body" label="Текст сообщения" label-for="body">
                <b-form-textarea
                    id="body"
                    v-model="form.body"
                    placeholder="Введите текст сообщения..."
                    rows="3"
                    max-rows="6"
                ></b-form-textarea>
            </b-form-group>

            <b-button v-if="!sending" @click="onSubmit" type="button" variant="primary">Отправить</b-button>
            <b-button v-else variant="primary" disabled>
                <b-spinner small type="grow"></b-spinner>
                Отправка письма
            </b-button>
        </b-form>

    </b-container>
</template>

<script>
    export default {
        name: "message",
        data(){
            return{
                form: {
                    email: '',
                    subject: '',
                    body: '',
                    phone: ''
                },
                sending: false
            }
        },
        mounted() {

        },
        methods:{
            onSubmit(evt) {

                /*evt.preventDefault();*/
                this.sending = true;
                axios.post('/message/send', {
                    params: {
                        form: this.form
                    }
                }).then((response) => {
                   console.log(response.data);
                   this.sending = false;
                   location.href = '/profile';
                }).catch(error => {
                    console.log(error);
                    this.sending = false;
                    alert('Что то произошло не так, приносим свои извинения за неудобства!')
                });
            }
        }
    }
</script>

<style scoped>

</style>
