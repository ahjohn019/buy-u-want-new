<template>
    <div class="relative ml-60">
        <div class="relative bg-blue-600 md:pt-32 pb-32 pt-12 px-6">
            <div
                class="p-6 text-white text-lg font-bold absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center"
            >
                <h1>Dashboard</h1>
            </div>
            <Summaries />
        </div>
        <div class="md:px-10 mx-auto w-full -m-10 px-4">
            <div class="flex flex-wrap">
                <LineCharts />
                <BarCharts />
            </div>
            <div class="flex flex-wrap">
                <TableOne />
            </div>
        </div>
    </div>
</template>

<script>
import LineCharts from "../../../Components/Admin/Dashboard/LineChart.vue";
import Summaries from "../../../Components/Admin/Dashboard/Summaries.vue";
import BarCharts from "../../../Components/Admin/Dashboard/BarChart.vue";
import TableOne from "../../../Components/Admin/Dashboard/TableOne.vue";

export default {
    components: {
        LineCharts,
        Summaries,
        BarCharts,
        TableOne,
    },
};
</script>
