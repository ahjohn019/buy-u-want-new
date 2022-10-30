<template>
    <Filter />
    <div class="relative mt-2">
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
