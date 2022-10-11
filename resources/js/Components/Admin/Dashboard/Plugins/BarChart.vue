<template>
    <div class="xl:w-4/12 px-4 w-full">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
        >
            <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h6
                            class="uppercase text-blueGray-400 mb-1 text-xs font-semibold"
                        >
                            Performance
                        </h6>
                        <h2 class="text-blueGray-700 text-xl font-semibold">
                            Total orders
                        </h2>
                    </div>
                </div>
            </div>
            <Bar
                :chart-options="chartOptions"
                :chart-data="chartData"
                :chart-id="chartId"
                :dataset-id-key="datasetIdKey"
                :plugins="plugins"
                :css-classes="cssClasses"
                :styles="styles"
                :width="width"
                :height="height"
            />
        </div>
    </div>
</template>
<script>
import { Bar } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from "chart.js";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
);

export default {
    name: "BarChart",
    components: { Bar },
    props: {
        chartId: {
            type: String,
            default: "bar-chart",
        },
        datasetIdKey: {
            type: String,
            default: "label",
        },
        width: {
            type: Number,
            default: 400,
        },
        height: {
            type: Number,
            default: 400,
        },
        cssClasses: {
            default: "",
            type: String,
        },
        styles: {
            type: Object,
            default: () => {},
        },
        plugins: {
            type: Object,
            default: () => {},
        },
    },
    data() {
        return {
            chartData: {
                labels: ["January", "February", "March"],
                datasets: [
                    {
                        data: [40, 20, 12],
                        label: "2022",
                        backgroundColor: "#DC143C",
                    },
                    {
                        data: [20, 30, 15],
                        label: "2021",
                        backgroundColor: "rgb(0, 255, 255)",
                    },
                ],
            },
            chartOptions: {
                responsive: true,
            },
        };
    },
};
</script>
