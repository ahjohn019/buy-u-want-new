<template>
    <Filter />
    <div class="relative mt-2">
        <div
            v-if="$page.props.flash.orderDeletedMessage"
            class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.orderDeletedMessage }}
            </span>
        </div>
        <div
            v-if="$page.props.flash.refundFailedMessage"
            class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.refundFailedMessage }}
            </span>
        </div>
        <div
            v-if="$page.props.flash.refundSuccessMessage"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.refundSuccessMessage }}
            </span>
        </div>
        <DataTable :order="order" :columns="columns" />
    </div>
</template>

<script>
import DataTable from "../Plugins/DataTable.vue";
import Filter from "../Plugins/Filter.vue";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        DataTable,
        Filter,
    },
    props: ["order", "columns"],
});
</script>
