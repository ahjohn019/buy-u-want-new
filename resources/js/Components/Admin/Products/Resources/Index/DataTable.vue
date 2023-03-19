<template>
    <ag-grid-vue
        style="height: 100%; width: 100%"
        class="ag-theme-alpine"
        :columnDefs="columnDefs"
        :rowData="rowData"
        :rowSelection="rowSelection"
        :row-height="150"
        @grid-ready="onGridReady"
        @selection-changed="onSelectionChanged"
    >
    </ag-grid-vue>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import { defineComponent } from "vue";
import Index from "./Button.vue";
import Image from "./Image.vue";
import "@custom-css/customStyle.css";

export default defineComponent({
    components: {
        AgGridVue,
        Index,
        Image,
    },
    props: ["products", "columns", "status"],
    data() {
        return {
            columnDefs: [],
            rowData: [],
            rowSelection: "multiple",
            selectedRows: null,
            gridApi: null,
        };
    },
    mounted() {
        try {
            const filterText = ["name", "description", "sku"];
            var columnDefs = this.columnDefs;
            this.rowData = this.products;

            this.columns.forEach(function (column, index) {
                columnDefs.push({
                    headerName: column,
                    field: column,
                    sortable: true,
                });

                if (column == "name") {
                    Object.assign(columnDefs[index], {
                        headerCheckboxSelection: true,
                        checkboxSelection: true,
                    });
                }

                if (column == "status" || column == "price") {
                    Object.assign(columnDefs[index], {
                        width: 90,
                    });
                }

                if (column == "attachments") {
                    Object.assign(columnDefs[index], {
                        cellRenderer: "Image",
                    });
                }

                if (filterText.includes(column)) {
                    Object.assign(columnDefs[index], {
                        filter: "agTextColumnFilter",
                    });
                }

                if (column == "category") {
                    Object.assign(columnDefs[index], {
                        valueGetter: (params) => {
                            return params.data.category.name;
                        },
                    });
                }

                if (column == "status") {
                    Object.assign(columnDefs[index], {
                        valueGetter: (params) => {
                            return params.data.status.name;
                        },
                    });
                }

                if (column == "attachments") {
                    Object.assign(columnDefs[index], {
                        valueGetter: (params) => {
                            return params.data.attachments.length > 0
                                ? params.data.attachments[0].name
                                : null;
                        },
                    });
                }
            });

            columnDefs.push({
                field: "action",
                sortable: true,
                headerName: "Action",
                cellRenderer: "Index",
                cellRendererParams: {
                    status: this.status,
                },
                width: 250,
            });
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        onSelectionChanged() {
            var selectedRows = this.gridApi.getSelectedRows();
            this.selectedRows = selectedRows;
        },
        onGridReady(params) {
            this.gridApi = params.api;
            this.$emit("gridApi", this.gridApi);
        },
    },
});
</script>
