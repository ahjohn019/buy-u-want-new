<template>
    <ag-grid-vue
        style="width: 100%"
        class="ag-theme-alpine"
        :columnDefs="columnDefs"
        :rowData="rowData"
        :rowSelection="rowSelection"
    >
    </ag-grid-vue>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        AgGridVue,
    },
    props: ["products", "columns"],
    data() {
        return {
            columnDefs: [],
            rowData: [],
            rowSelection: "multiple",
        };
    },
    mounted() {
        try {
            const filterText = ["name", "description", "sku"];
            var columnDefs = this.columnDefs;
            this.rowData = this.products;

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

                if (filterText.includes(column)) {
                    Object.assign(columnDefs[index], {
                        filter: "agTextColumnFilter",
                    });
                }
            });
        } catch (error) {
            console.error(error);
        }
    },
});
</script>
