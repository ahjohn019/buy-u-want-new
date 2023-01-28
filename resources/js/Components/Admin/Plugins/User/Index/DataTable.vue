<template>
    <ag-grid-vue
        style="width: 100%; height: 75vh"
        class="ag-theme-alpine"
        :columnDefs="userData().columns"
        :rowData="userData().rows"
        @grid-ready="onGridReady"
    >
    </ag-grid-vue>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import Action from "./Action.vue";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        Action,
        AgGridVue,
    },
    props: ["users"],

    setup(props) {
        const usersColumn =
            props.users.length > 0 ? Object.keys(props.users[0]) : null;

        const gridApi = null;

        return { gridApi, usersColumn };
    },
    methods: {
        onGridReady(params) {
            this.gridApi = params.api;
        },
        userData() {
            const userColumnTable = [];

            if (this.usersColumn !== null) {
                this.usersColumn.forEach(function (el) {
                    userColumnTable.push({
                        headerName: el,
                        field: el,
                        sortable: true,
                    });
                });
            }

            userColumnTable.push({
                headerName: "Action",
                field: "Action",
                cellRenderer: "Action",
            });

            const columnDefs = userColumnTable;
            const rowData = this.users;

            return { columns: columnDefs, rows: rowData };
        },
    },
});
</script>
