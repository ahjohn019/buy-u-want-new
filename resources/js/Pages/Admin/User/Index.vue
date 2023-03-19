<script setup>
import Base from "../Base.vue";
import Index from "@web/Admin/User/Index.vue";
import Header from "@web/Master/Admin/Header.vue";

defineProps(["users"]);

function header() {
    return "Users";
}
</script>

<template>
    <Base>
        <template #title>
            <Header :title="header()" />
        </template>

        <template #admin>
            <div class="container mx-auto px-6">
                <Index :users="users" />
            </div>
        </template>
    </Base>
</template>
