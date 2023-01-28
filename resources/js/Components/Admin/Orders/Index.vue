<template>
    <Filter />
    <div class="relative mt-2">
        <Session />
        <DataTable :order="order" :columns="columns" />
    </div>
</template>

<script>
import DataTable from "@admin-plugins/Orders/Index/DataTable.vue";
import Filter from "@admin-plugins/Orders/Index/Filter.vue";
import Session from "@admin-plugins/Orders/Index/Session.vue";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        DataTable,
        Filter,
        Session,
    },
    props: ["order", "columns"],
});
</script>
