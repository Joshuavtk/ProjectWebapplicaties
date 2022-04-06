<template>
    <div
        class="bg-white dark:bg-neutral-800 shadow overflow-hidden sm:rounded-lg"
    >
        <div class="px-4 py-5 sm:px-6">
            <h3
                class="text-lg leading-6 font-medium text-gray-900 dark:text-white"
            >
                Weerstations
            </h3>
            <!-- <p class="mt-1 max-w-2xl text-sm text-gray-500"></p> -->
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700">
            <table class="table-auto w-full mt-5">
                <thead>
                    <th
                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                    >
                        Station
                    </th>
                    <th
                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                    >
                        Longitude
                    </th>
                    <th
                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                    >
                        Latitude
                    </th>
                    <th
                        class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"
                    >
                        Elevation
                    </th>
                </thead>

                <tbody>
                    <tr
                        v-for="station in stations"
                        @click="
                            $router.push({
                                name: 'station.view',
                                params: { stationName: station.name },
                            })
                        "
                        class="odd:bg-white even:bg-slate-50 dark:odd:bg-neutral-800 dark:even:bg-gray-800 hover:cursor-pointer hover:bg-slate-300 ease-linear duration-75"
                    >
                        <td
                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"
                        >
                            {{ station.name }}
                        </td>
                        <td
                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"
                        >
                            {{ station.longitude }}
                        </td>
                        <td
                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"
                        >
                            {{ station.latitude }}
                        </td>
                        <td
                            class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400"
                        >
                            {{ station.elevation }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="my-3 flex text-center justify-center">
                <button
                    @click="changePage(pagination.current_page - 1)"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-200 dark:hover:bg-slate-700 dark:text-gray-200"
                >
                    Previous
                </button>
                <button
                    v-if="pagination.current_page != 1"
                    @click="changePage(1)"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-200 dark:hover:bg-slate-700 dark:text-gray-200"
                >
                    1
                </button>
                <div
                    v-if="pagination.current_page != 1"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 dark:text-gray-200"
                >
                    ...
                </div>
                <div
                    class="font-bold rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 dark:text-gray-50"
                >
                    {{ pagination.current_page }}
                </div>
                <div
                    v-if="pagination.current_page != pagination.total_pages"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 dark:text-gray-200"
                >
                    ...
                </div>
                <button
                    v-if="pagination.current_page != pagination.total_pages"
                    @click="changePage(pagination.total_pages)"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-200 dark:hover:bg-slate-700 dark:text-gray-200"
                >
                    {{ pagination.total_pages }}
                </button>
                <button
                    @click="changePage(pagination.current_page + 1)"
                    class="rounded-none bg-slate-100 dark:bg-slate-800 p-3 border border-slate-200 dark:border-slate-700 hover:bg-slate-200 dark:hover:bg-slate-700 dark:text-gray-200"
                >
                    Next
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { RouterLink } from "vue-router";
export default {
    name: "Stations",
    components: {
        RouterLink,
    },
    mounted() {
        this.getStations();
    },
    computed: {
        stations() {
            return this.$store.state.station.all;
        },
        pagination() {
            return this.$store.state.station.pagination;
        },
    },
    methods: {
        getStations() {
            this.$store.dispatch("station/getAll", 1);
            document.title = "Overzicht weerstations " + " - IWA";
        },
        changePage(pageNum) {
            this.$store.dispatch("station/getAll", pageNum);
        },
    },
};
</script>
