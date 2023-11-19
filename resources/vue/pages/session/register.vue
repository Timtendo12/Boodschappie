<template>
    <layout>
        <form @submit.prevent="submit">
            <div class="w-screen h-screen bg-login flex flex-col items-center justify-center px-5 py-28">
                <div class="rounded-2xl border-2 border-gray-100 bg-white pt-10 w-full md:w-1/2 md:h-full h-3/5 flex flex-col items-center justify-around drop-shadow-2xl max-md:gap-5">
                    <div class="text-xl font-bold flex flex-col items-center justify-center">
                        <h1 class="text-2xl drop-shadow">Boodschappie</h1>
                        <h1>Registreren</h1>
                    </div>
                    <div class="w-full px-7">
                        <div class="flex flex-row w-full mb-4 text-sm gap-2">
                            <input v-model="firstName" type="text" placeholder="Voornaam" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2">
                            <input v-model="lastName" type="text" placeholder="Achternaam" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2">
                        </div>
                        <input v-model="email" type="email" placeholder="E-mail" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm mb-4">
                        <input v-model="password" type="password" placeholder="Wachtwoord" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm mb-4">
                        <input v-model="password_confirm" type="password" placeholder="Wachtwoord bevestigen" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm">
                    </div>
                    <div class="w-full px-7 flex flex-col items-center justify-between">
                        <button type="submit" class="font-bold text-white bg-blue-600 px-1.5 py-2.5 rounded-lg text-sm w-full">Registreren</button>
                        <p class="text-xs mt-10">Waneer je je registreert ga je akkoord met gekke shit.</p>
                    </div>
                </div>
            </div>
        </form>
    </layout>
</template>

<script>
import { toast } from 'vue3-toastify';
import axios from "axios";
import Layout from "../../layouts/layout.vue";
export default {
    name: "Register",
    components: {Layout},
    data() {
      return {
          firstName: "",
          lastName: "",
          email: "",
          password: "",
          password_confirm: "",
      }
    },
    methods: {
        submit(payload) {
            axios.post('/register', {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirm
            }).then((response) => {

            }).catch((err) => {

            })
        }
    }
}
</script>

<style scoped>

.bg-login {
    background: linear-gradient(180deg, #e3ffe7 0%, #d9e7ff 100%);
}

</style>
