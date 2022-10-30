<template>
    <div v-if="selectedRows.length > 0">
        <BulkButton :selectedRows="selectedRows" />
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
import BulkButton from "./BulkButton.vue";

export default defineComponent({
    components: {
        AgGridVue,
        BulkButton,
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
            for (const [key, value] of Object.entries(this.columns)) {
                this.columnDefs.push({
                    headerName: value,
                    field: value,
                    sortable: true,
                });

                if (this.columnDefs[key].field == "number") {
                    this.columnDefs[key] = Object.assign(this.columnDefs[key], {
                        headerCheckboxSelection: true,
                        checkboxSelection: true,
                    });
                }
            }
            for (var i in this.order) {
                this.rowData.push(this.order[i]);
            }

            this.columnDefs.push({
                field: "action",
                sortable: true,
                headerName: "Action",
                // cellRenderer: "RefundButton",
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
