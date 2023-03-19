<template>
    <Filter />
    <div class="relative mt-2">
        <Session />
        <DataTable :order="order" :columns="columns" />
    </div>
</template>

<script>
import DataTable from "@admin/Orders/Resources/Index/DataTable.vue";
import Filter from "@admin/Orders/Resources/Index/Filter.vue";
import Session from "@admin/Orders/Resources/Index/Session.vue";
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
