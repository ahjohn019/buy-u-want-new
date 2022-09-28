<template>
    <div class="xl:w-8/12 mb-12 xl:mb-0 px-4 w-full">
        <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-700 text-white"
        >
            <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h6 class="uppercase mb-1 text-xs font-semibold">
                            Overview
                        </h6>
                        <h2 class="text-xl font-semibold">Sales value</h2>
                    </div>
                </div>
            </div>
            <Line
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
import { Line } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    CategoryScale,
} from "chart.js";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    CategoryScale
);

export default {
    name: "LineChart",
    components: { Line },
    props: {
        chartId: {
            type: String,
            default: "line-chart",
        },
        datasetIdKey: {
            type: String,
            default: "label",
        },
        width: {
            type: Number,
            default: 250,
        },
        height: {
            type: Number,
            default: 120,
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
                labels: [],
                datasets: [],
            },
            chartOptions: {
                responsive: true,
                scales: {
                    y: {
                        ticks: {
                            color: "#FFFFFF",
                            font: {
                                size: 14,
                            },
                        },
                    },
                    x: {
                        ticks: {
                            color: "#FFFFFF",
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: "#FFFFFF",
                        },
                    },
                },
            },
        };
    },
    mounted() {
        try {
            axios.get(route("chart.orders")).then((response) => {
                let result = response.data.ordersData;
                this.chartData.labels = response.data.monthList;
                for (const [key, value] of Object.entries(result)) {
                    this.chartData.datasets.push({
                        label: key,
                        backgroundColor: Object.values(value.months),
                        data: value.months,
                        borderColor: value.colors,
                    });
                }
            });
        } catch (error) {}
    },
};
</script>
