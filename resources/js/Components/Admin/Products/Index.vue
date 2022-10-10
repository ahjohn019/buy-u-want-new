<template>
    <div class="relative">
        <div class="px-6 flex justify-end items-center pt-2">
            <form method="get" :action="route('products.admin')">
                <input
                    type="text"
                    name="productSearch"
                    class="rounded border border-gray-200 outline-none focus:outline focus:transition"
                    placeholder="Input Your Product"
                />
                <n-button attr-type="submit" value="search" class="ml-4"
                    >Search</n-button
                >
            </form>
            <n-button type="info" class="bg-blue-600 ml-4"> Create </n-button>
        </div>

        <div
            class="grid grid-cols-1 md:grid-cols-4 m-4"
            style="min-height: 650px"
        >
            <Filter
                :products="products"
                :columns="columns"
                :maxPrice="maxPrice"
            />
            <DataTable
                :products="products"
                :columns="columns"
                class="col-span-3"
            />
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import Filter from "../Products/Filter.vue";
import DataTable from "../Products/DataTable.vue";
import { NButton } from "naive-ui";

export default defineComponent({
    components: {
        Filter,
        DataTable,
        NButton,
    },
    props: ["products", "columns", "maxPrice"],
});
</script>
