import { stationService } from '@/services/station.service.js'

const state = {
    status: {},
    station: {},
}


const actions = {
    getData({ state, commit, dispatch }, stationName) {
        commit('getStationData')

        stationService.getStationData(stationName).then(data => {
            let station = data.station
            commit('setStationData', station)
        }).catch(error => {
            // Show error message on fail and redirect back to overview
            // commit('createFailure')
            let errors = ['Er is iets misgegaan, probeer het opnieuw.']
            if (error.response) {
                if (typeof error.response.data === 'object' && typeof error.response.data.errors === 'object') {
                    errors = flatten(
                        toArray(error.response.data.errors)
                    )
                }
            }
            // dispatch('alert/error', errors, { root: true })
            // router.push({ name: 'stations' })
        })
    },
}


const mutations = {
    getStationData(state) {
        state.status = { inProgress: true }
    },
    setStationData(state, station) {
        state.status = { finished: true }
        state.station = station
    },

}

export const station = {
    namespaced: true,
    state,
    actions,
    mutations,
}
