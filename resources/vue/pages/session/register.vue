<template>
    <layout>
        <form v-if="!hasSubmitted" @submit.prevent="submit">
            <div class="w-screen h-screen bg-login flex flex-col items-center justify-center px-5 py-28">
                <div class="rounded-2xl border-2 border-gray-100 bg-white pt-10 w-full md:w-1/2 md:h-fit h-fit flex flex-col items-center justify-between drop-shadow-2xl max-md:gap-5">
                    <div class="text-xl font-bold flex flex-col items-center justify-center">
                        <h1 class="text-2xl drop-shadow">Boodschappie</h1>
                        <h1>Registreren</h1>
                    </div>
                    <div class="w-full px-7 mb-4">
                        <div class="flex flex-row w-full mb-4 gap-2">
                            <input v-model="firstName" type="text" placeholder="Voornaam" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm">
                            <input v-model="lastName" type="text" placeholder="Achternaam" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm">
                        </div>
                        <input v-model="email" type="email" placeholder="E-mail" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm mb-4">
                        <input v-model="password" type="password" placeholder="Wachtwoord" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm mb-4">
                        <input v-model="password_confirm" type="password" placeholder="Wachtwoord bevestigen" class="border-[1px] border-gray-200 rounded-lg w-full px-3 py-2 text-sm">
                    </div>
                    <div class="w-full px-7 flex flex-col items-center justify-between">
                        <button v-if="!hasSubmitted" type="submit" class="font-bold text-white bg-blue-600 px-1.5 py-2.5 rounded-lg text-sm w-full">Registreren</button>
                        <button v-else type="button" class="font-bold text-white bg-blue-600 px-1.5 py-2.5 rounded-lg text-sm w-full hover:cursor-pointer opacity-80 flex flex-row items-center justify-center ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 animate-spin opacity-80 hover:cursor-none">
                                <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <p class="text-xs mt-10 pb-7">Waneer je je registreert ga je akkoord met gekke shit.</p>
                    </div>
                </div>
            </div>
        </form>
        <div v-else class="w-screen h-screen bg-login flex flex-col items-center justify-center px-5 py-28">
            <div class="rounded-2xl border-2 border-gray-100 bg-white pt-10 w-full md:w-1/2 md:h-fit h-fit flex flex-col items-center justify-between drop-shadow-2xl max-md:gap-5">
                <div class="text-xl font-bold flex flex-col items-center justify-center">
                    <h1 class="text-2xl drop-shadow">Boodschappie</h1>
                    <h1>Email verifieren</h1>
                </div>
                <div class="w-full px-7">
                    <p class="px-3 py-2 text-md text-center text-gray-500">Om de app volledig te benutten, dien je eerst je e-mail te verifiëren. We hebben je een e-mail gestuurd met een link waarmee je dit kunt voltooien</p>
                    <p v-if="showSendEmailAgain" v-on:click="resendEmail" class="px-3 py-2 text-md text-center">Email opnieuw versturen</p>
                </div>
                <div class="text-sm px-3 py-2 text-center">
                    <p>Heb je je email al geverfieerd?</p>
                    <p >Keer terug naar het <a href="/app/login/" class="text-blue-500 hover:underline hover:cursor-pointer font-bold">inlogscherm</a></p>
                </div>
            </div>
        </div>
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
          hasSubmitted: false,
          showSendEmailAgain: false
      }
    },
    methods: {
        submit() {
            // validate the form
            if (this.firstName === "") {
                toast.error("Voornaam is verplicht");
                return;
            }

            if (this.lastName === "") {
                toast.error("Achternaam is verplicht");
                return;
            }

            if (this.email === "") {
                toast.error("E-mail is verplicht");
                return;
            }

            if (this.password === "") {
                toast.error("Wachtwoord is verplicht");
                return;
            }

            if (this.password_confirm === "") {
                toast.error("Wachtwoord bevestigen is verplicht");
                return;
            }

            if (this.password !== this.password_confirm) {
                toast.error("Wachtwoorden komen niet overeen");
                return;
            }

            axios.post('/app/register', {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirm
            }).then((response) => {
                if (response.status === 201) {
                    const user = response.data.data;

                    if (user.auth_session == null) {
                        toast.error("Er ging iets mis. Probeer het later nog eens of neem contact op.");
                        return;
                    }

                    sessionStorage.setItem("auth_session", user.auth_session);
                    this.hasSubmitted = true;

                    setTimeout(() => {
                        this.showSendEmailAgain = true;
                    }, 20000);
                } else if (response.status > 400 && response.status < 499) {
                    toast.error(response.data.message);
                } else toast.warning("Hmmm. Er ging iets mis. Probeer het later nog eens of neem contact op.");
            }).catch((err) => {
                toast.error(err.response.data.message)
            })
        },
        resendEmail() {
            this.showSendEmailAgain = false;
            const session = sessionStorage.getItem("auth_session");

            if (session === null) {
                // BS-0003: No session identifier found in session storage.
                toast.error("Code BS-0003: Er ging iets mis. Probeer het later nog eens of neem contact op.");
                return;
            }

            axios.post('/api/session/resend', {
                email: this.email,
                session: sessionStorage.getItem("auth_session")
            }).then((response) => {
                if (response.status >= 200) {
                    toast.success("E-mail opnieuw verstuurd");
                } else toast.warning("Hmmm. Er ging iets mis. Probeer het later nog eens of neem contact op.");
            }).catch((err) => {
                toast.error(err.data.message)
            }).finally(() => {
                setTimeout(() => {
                    this.showSendEmailAgain = true;
                }, 40000);
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
