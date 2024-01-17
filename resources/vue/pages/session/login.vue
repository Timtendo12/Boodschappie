<template>
    <layout>
        <form @submit.prevent="submit">
            <div class="w-screen h-screen bg-login flex flex-col items-center justify-center px-5 py-28">
                <div class="rounded-2xl border-2 border-gray-100 bg-white py-10 w-full md:w-1/2 h-fit flex flex-col items-center justify-between drop-shadow-2xl max-md:gap-5">
                    <div class="text-xl font-bold flex flex-col items-center justify-center mb-4">
                        <h1 class="text-2xl drop-shadow">Boodschappie</h1>
                        <h1>Inloggen</h1>
                    </div>
                    <div class="w-full px-7 mb-4">
                        <input v-model="email" type="email" placeholder="E-mail" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 mb-4 text-sm">
                        <input v-model="password" type="password" placeholder="Wachtwoord" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 mb-4 text-sm">
                        <div class="flex flex-row justify-items-start items-center">
                            <input v-model="remember" type="checkbox" class="mr-2 rounded-sm h-3 w-3">
                            <p class="text-sm" >Onthoud mij</p>
                        </div>
                    </div>
                    <div class="w-full px-7 flex md:flex-row-reverse flex-col items-center justify-between md:gap-0 gap-5">
                        <button class="font-bold text-white bg-blue-600 px-1.5 py-2.5 rounded-lg text-sm w-full md:w-1/3 md:min-w-fit">Inloggen</button>
                        <div class="flex flex-col flex text-xs">
                            <p>Nog geen account?</p>
                            <a href="/app/register" class="text-blue-500 font-bold">Registreer hier</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </layout>
</template>

<script>
import Layout from "../../layouts/layout.vue";
import axios from "axios";
import {toast} from "vue3-toastify";

export default {
    name: 'Login',
    components: {Layout},
    data() {
        return {
            email: "",
            password: "",
            remember: false,
        }
    },
    methods: {
        submit() {
            // validate the form
            if (this.email === "") {
                toast.error("E-mail is verplicht");
                return;
            }

            if (this.password === "") {
                toast.error("Wachtwoord is verplicht");
                return;
            }

            debugger;

            // submit the form
            axios.post("/app/login", {
                email: this.email,
                password: this.password,
                remember: this.remember
            }).then((response) => {
                if (response.data.status >= 200 && response.data.status < 300) {
                    window.location.href = "/app/dashboard";
                } else {
                    toast.error("Er is iets misgegaan");
                }
            }).catch((error) => {
                toast.error("Er is iets misgegaan");
            });
        }
    }
}
</script>

<style scoped>

.bg-login {
    background: linear-gradient(180deg, #e3ffe7 0%, #d9e7ff 100%);
}

</style>
