<template>
    <div class="grid grid-cols-3 gap-4 container mx-auto p-6">
        <!-- Products -->
        <div class="p-4 border rounded-lg col-span-2">
            <div class="pb-4 font-semibold">
                <h3>Products</h3>
            </div>

            <div class="mt-2">
                <DataTable
                    :products="products"
                    :columns="columns"
                    :selectedUser="selectedUser"
                />
            </div>
        </div>

        <div>
            <Customer
                :users="users"
                @handleUserSelected="handleChildUserSelected"
            />
        </div>
    </div>
</template>

<script>
import { defineComponent, computed } from "vue";
import DataTable from "@admin-plugins/Orders/Create/DataTable.vue";
import Customer from "@admin-plugins/Orders/Create/Customer.vue";

export default defineComponent({
    components: {
        DataTable,
        Customer,
    },
    props: ["products", "columns", "users"],
    data() {
        return {
            selectedUser: null,
            remove: null,
        };
    },
    provide() {
        return {
            displayUser: computed(() => this.remove),
        };
    },
    methods: {
        handleChildUserSelected(value) {
            this.selectedUser = value.selectUser;
            this.remove = value.displayUser;
            console.log(this.selectedUser);
        },
    },
});
</script>
