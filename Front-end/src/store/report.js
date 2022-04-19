import { apiService } from "@/services/api.service.js";
import router from "../router";
const state = {
    status: {},
    report: {},
}

const actions =  {
    getReports({ state, commit, dispatch }, items) {
        commit("started")
        return apiService.doGetCall("/getReports")
            .then(response => {
                commit("finished")
                return response
            })
            .catch(error => {
                return error
            })
    }
}

const mutations = {
    started(state) {
        state.status = { inProgress: true }
    },
    finished(state) {
        state.status = { finished: true }
    }
}

export const report = {
    namespaced: true,
    actions,
    mutations
}
