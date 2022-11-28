<template>
    <Filter />
    <div class="relative mt-2">
        <Session />
        <DataTable :order="order" :columns="columns" />
    </div>
</template>

<script>
import DataTable from "../Plugins/Index/DataTable.vue";
import Filter from "../Plugins/Index/Filter.vue";
import Session from "../Plugins/Index/Session.vue";
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
