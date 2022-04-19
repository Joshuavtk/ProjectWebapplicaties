import { apiService } from "@/services/api.service.js";
import router from "../router";
import VueJwtDecode from "vue-jwt-decode";

const state = {
    status: {},
    login: {},
}

const actions =  {
    login({ state, commit, dispatch }, items) {
        commit("loginStarted")
        apiService.doPostCall("/authentication", items.body)
            .then(response => {
                commit("loginFinished")
                let token = response.data.token
                let user = VueJwtDecode.decode(token)

                localStorage.setItem("user", JSON.stringify({ api_token: token, user: user }))
                router.push("/dashboard")
            })
            .catch(error => {
                items.errorField.innerText = error.response.data.message
            })
    }
}

const mutations = {
    loginStarted(state) {
        state.status = { inProgress: true }
    },
    loginFinished(state) {
        state.status = { finished: true }
    }
}

export const login = {
    namespaced: true,
    actions,
    mutations
}
