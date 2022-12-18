<script setup>
import DataTable from "../Plugins/Index/DataTable.vue";

defineProps(["users"]);
</script>

<template>
    <div class="relative mt-2">
        <DataTable :users="users" />
    </div>
</template>
