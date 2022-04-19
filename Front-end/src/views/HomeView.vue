<template>
    <div class="login">
        <div class="p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="space-y-6">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white text-center">IWA</h5>
                <p ref="errorField" class="text-red-600"/>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email adres</label>
                    <input type="email" v-model="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Wachtwoord</label>
                    <input type="password" v-model="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>

                <button type="submit" @click="login" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Inloggen
                </button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Nog geen account?
                    <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">
                        Account aanmaken
                    </a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import router from "../router";
import VueJwtDecode from 'vue-jwt-decode'
export default {
    methods: {
        login() {
            this.$store.dispatch("login/login", { body: { email: this.email, password: this.password }, errorField: this.$refs.errorField })
        }
    },
    beforeMount() {
        if (localStorage.hasOwnProperty("user")) {
            router.push("/dashboard")
        }
    }
}
</script>
