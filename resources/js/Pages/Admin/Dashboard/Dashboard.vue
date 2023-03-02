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
            <!-- <div class="flex flex-wrap">
                <TableOne />
            </div> -->
        </div>
    </div>
</template>

<script>
import LineCharts from "@admin-plugins/Dashboard/LineChart.vue";
import Summaries from "@admin-plugins/Dashboard/Summaries.vue";
import BarCharts from "@admin-plugins/Dashboard/BarChart.vue";
import TableOne from "@admin-plugins/Dashboard/TableOne.vue";

export default {
    components: {
        LineCharts,
        Summaries,
        BarCharts,
        TableOne,
    },
};
</script>
