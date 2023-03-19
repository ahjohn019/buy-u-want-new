<template>
    <div class="space-y-4 d-flex flex-col">
        <div class="d-flex justify-end">
            <CreateButton />
        </div>
        <div>
            <ag-grid-vue
                style="width: 100%; height: 75vh"
                class="ag-theme-alpine"
                :columnDefs="userData().columns"
                :rowData="userData().rows"
                @grid-ready="onGridReady"
            >
            </ag-grid-vue>
        </div>
    </div>
</template>

<script>
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import { AgGridVue } from "ag-grid-vue3";
import { defineComponent } from "vue";
import CreateButton from "@admin/User/Button/Create/Button.vue";
import Action from "./Action.vue";

export default defineComponent({
    components: {
        Action,
        AgGridVue,
        CreateButton,
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
            const columnDefs = [
                {
                    headerName: "name",
                    field: "name",
                    sortable: true,
                    flex: 2,
                },
                {
                    headerName: "email",
                    field: "email",
                    sortable: true,
                    flex: 2,
                },
                {
                    headerName: "created_at",
                    field: "created_at",
                    sortable: true,
                    flex: 1,
                },
                {
                    headerName: "Action",
                    field: "Action",
                    cellRenderer: "Action",
                    flex: 1,
                },
            ];

            const rowData = [];

            this.users.forEach((el) => {
                rowData.push({
                    id: el.id,
                    name: el.name,
                    email: el.email,
                    created_at: el.created_at,
                });
            });

            return { columns: columnDefs, rows: rowData };
        },
    },
});
</script>
