<template>
    <div class="relative">
        <div
            v-if="$page.props.flash.createProductSuccesMessage"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.createProductSuccesMessage }}
            </span>
        </div>
        <div class="flex justify-end items-center pt-2">
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
            <Link
                :href="route('products.create')"
                class="bg-blue-600 ml-4 text-white py-2 px-3 hover:bg-blue-800 rounded"
                method="get"
                as="button"
                type="button"
                >Create</Link
            >
        </div>

        <div
            class="grid grid-cols-1 mt-4"
            style="min-height: 650px"
            :class="[products.length > 0 ? 'md:grid-cols-4' : 'md:grid-cols-3']"
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
import Filter from "@admin-plugins/Products/Index/Filter.vue";
import DataTable from "@admin-plugins/Products/Index/DataTable.vue";
import { NButton } from "naive-ui";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Filter,
        DataTable,
        NButton,
        Link,
    },
    props: ["products", "columns", "maxPrice"],
});
</script>
