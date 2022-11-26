<template>
    <div v-if="selectedRows.length > 0">
        <p>{{ selectedRows.length }} rows selected</p>
    </div>
    <ag-grid-vue
        style="width: 100%; height: 400px"
        class="ag-theme-alpine"
        :columnDefs="columnDefs"
        :rowData="rowData"
        :rowSelection="rowSelection"
        @grid-ready="onGridReady"
        @selection-changed="onSelectionChanged"
    >
    </ag-grid-vue>

    <div class="mt-4">
        <PaymentTable :selectedRows="selectedRows" :total="total" />
    </div>

    <div class="flex space-x-2 justify-end mt-4">
        <div>
            <InvoiceButton />
        </div>
        <div>
            <PaymentButton :selectedRows="selectedRows" :total="total" />
        </div>
    </div>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import PaymentTable from "../Product/Payment.vue";
import PaymentButton from "../Button/Order/Draft/Payment.vue";
import InvoiceButton from "../Button/Order/Draft/Invoice.vue";
import { NDropdown, NButton } from "naive-ui";

export default {
    name: "App",
    components: {
        AgGridVue,
        PaymentTable,
        PaymentButton,
        InvoiceButton,
        NDropdown,
        NButton,
    },
    props: ["products", "columns"],

    data() {
        return {
            rowData: [],
            columnDefs: [],
            rowSelection: "multiple",
            gridApi: null,
            selectedRows: [],
            initialPrice: 0,
            total: 0,
            options: [],
        };
    },
    mounted() {
        this.rowData = this.products;
        var columnDefs = this.columnDefs;

        this.columns.map(function (column, index) {
            columnDefs.push({
                headerName: column,
                field: column,
                sortable: true,
            });

            if (column == "name") {
                Object.assign(columnDefs[index], {
                    headerCheckboxSelection: true,
                    checkboxSelection: true,
                    filter: "agTextColumnFilter",
                });
            }
        });
    },
    methods: {
        sumChanged(selectedRows) {
            const getPriceList = selectedRows.map((res) => res.price);
            const sumPrice = getPriceList.reduce(
                (current, previous) => current + previous,
                this.initialPrice
            );
            this.total = sumPrice;
        },

        onSelectionChanged() {
            var selectedRows = this.gridApi.getSelectedRows();
            this.selectedRows = selectedRows;
            this.sumChanged(this.selectedRows);
        },
        onGridReady(params) {
            this.gridApi = params.api;
        },
    },
};
</script>
