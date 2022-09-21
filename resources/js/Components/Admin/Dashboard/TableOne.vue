<template>
    <div class="xl:w-8/12 mb-12 xl:mb-0 px-4 md:w-full">
        <div
            class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
        >
            <ag-grid-vue
                style="width: 100%; height: 350px"
                class="ag-theme-alpine"
                :columnDefs="columnDefs"
                :defaultColDef="defaultColDef"
                :rowData="rowData"
            >
            </ag-grid-vue>
        </div>
    </div>
</template>
<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";

export default {
    name: "App",
    components: {
        AgGridVue,
    },
    setup() {
        return {
            columnDefs: [
                { headerName: "Make", field: "make" },
                { headerName: "Model", field: "model" },
                {
                    headerName: "Price",
                    field: "price",
                },
            ],
            defaultColDef: {
                flex: 1,
                sortable: true,
                resizable: true,
                filter: true,
            },
            rowData: [
                { make: "Toyota", model: "Celica", price: 35000 },
                { make: "Ford", model: "Mondeo", price: 32000 },
                { make: "Porsche", model: "Boxster", price: 72000 },
            ],
        };
    },
};
</script>
