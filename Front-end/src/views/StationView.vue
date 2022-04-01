<template>
    <div class="about">
        <h1>Weerstation: {{ station }}</h1>
    </div>
</template>

<script>
export default {
    name: 'Station',
    mounted() {
        this.getStation(this.$route.params.stationName)
    },
    computed: {
        station() {
            return this.$store.state.station.station
        },
    },
    methods: {
        getStation(stationName) {
            this.$store.dispatch('station/getData', stationName)
            document.title = 'Weerstation ' + stationName + ' - IWA'
        },
    },
}
</script>
