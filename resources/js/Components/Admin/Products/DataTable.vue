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
            rowSelection: "single",
        };
    },
    mounted() {
        try {
            const filterText = ["name", "description", "sku"];

            for (const [key, value] of Object.entries(this.columns)) {
                this.columnDefs.push({
                    headerName: value,
                    field: value,
                    sortable: true,
                });

                if (this.columnDefs[key].headerName == "id") {
                    this.columnDefs[key] = Object.assign(this.columnDefs[key], {
                        headerCheckboxSelection: true,
                        checkboxSelection: true,
                    });
                }

                filterText.map((filter) => {
                    if (this.columnDefs[key].headerName == filter) {
                        this.columnDefs[key] = Object.assign(
                            this.columnDefs[key],
                            {
                                filter: "agTextColumnFilter",
                            }
                        );
                    }
                });
            }

            for (var i in this.products) {
                this.rowData.push(this.products[i]);
            }
        } catch (error) {
            console.error(error);
        }
    },
});
</script>
