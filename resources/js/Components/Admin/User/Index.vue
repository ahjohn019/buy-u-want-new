<script setup>
import DataTable from "@admin/User/Resources/DataTable.vue";

defineProps(["users"]);
</script>

<template>
    <div
        v-if="$page.props.flash.createUserMessage"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.createUserMessage }}
        </span>
    </div>
    <div class="relative mt-2">
        <DataTable :users="users" />
    </div>
</template>
