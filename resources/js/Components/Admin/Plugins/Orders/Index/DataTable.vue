<template>
    <div v-if="selectedRows.length > 0" class="flex space-x-2">
        <Fulfilled :selectedRows="selectedRows" />
        <Archive :selectedRows="selectedRows" />
        <Refund :selectedRows="selectedRows" />
    </div>
    <ag-grid-vue
        style="width: 100%; height: 75vh"
        class="ag-theme-alpine"
        :columnDefs="columnDefs"
        :rowData="rowData"
        :rowSelection="rowSelection"
        @grid-ready="onGridReady"
        @selection-changed="onSelectionChanged"
        :pagination="true"
    >
    </ag-grid-vue>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import { defineComponent } from "vue";
import Fulfilled from "@admin-plugins/Orders/Index/Selection/Fulfilled.vue";
import Archive from "@admin-plugins/Orders/Index/Selection/Archive.vue";
import Refund from "@admin-plugins/Orders/Index/Selection/Refund.vue";
import Action from "@admin-plugins/Orders/Index/Details/Action.vue";

export default defineComponent({
    components: {
        AgGridVue,
        Fulfilled,
        Archive,
        Action,
        Refund,
    },
    props: ["order", "columns"],
    data() {
        return {
            columnDefs: [],
            rowData: [],
            rowSelection: "multiple",
            gridApi: null,
            selectedRows: [],
        };
    },
    mounted() {
        try {
            this.rowData = this.order;
            var columnDefs = this.columnDefs;

            this.columns.map(function (column, index) {
                columnDefs.push({
                    headerName: column,
                    field: column,
                    sortable: true,
                });
                if (column == "id") {
                    Object.assign(columnDefs[index], {
                        headerCheckboxSelection: true,
                        checkboxSelection: true,
                    });
                }
            });

            columnDefs.push({
                field: "action",
                sortable: true,
                headerName: "Action",
                cellRenderer: "Action",
            });
        } catch (error) {}
    },
    methods: {
        onSelectionChanged() {
            var selectedRows = this.gridApi.getSelectedRows();
            this.selectedRows = selectedRows;
        },
        onGridReady(params) {
            this.gridApi = params.api;
        },
    },
});
</script>
