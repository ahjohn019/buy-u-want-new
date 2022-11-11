<template>
    <div class="relative">
        <div class="relative pt-8 pb-32 px-6">
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
import LineCharts from "../Plugins/LineChart.vue";
import Summaries from "../Plugins/Summaries.vue";
import BarCharts from "../Plugins/BarChart.vue";
import TableOne from "../Plugins/TableOne.vue";

export default {
    components: {
        LineCharts,
        Summaries,
        BarCharts,
        TableOne,
    },
};
</script>
