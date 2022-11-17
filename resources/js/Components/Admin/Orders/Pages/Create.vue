<template>
    <div class="grid grid-cols-3 gap-4 container mx-auto p-6">
        <!-- Products -->
        <div class="p-4 border rounded-lg col-span-2">
            <div class="pb-4 font-semibold">
                <h3>Products</h3>
            </div>

            <div class="mt-2">
                <DataTable :products="products" :columns="columns" />
            </div>
        </div>

        <div>
            <Customer :users="users" />
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import DataTable from "../Plugins/Product/DataTable.vue";
import Customer from "../Plugins/Product/Customer.vue";
import { NButton } from "naive-ui";

export default defineComponent({
    components: {
        DataTable,
        NButton,
        Customer,
    },
    props: ["products", "columns", "users"],
});
</script>
