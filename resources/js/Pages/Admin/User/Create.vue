<script setup>
import Base from "../Base.vue";
import Header from "@web/Master/Admin/Header.vue";
import Create from "@web/Admin/User/Pages/Create.vue";

function header() {
    return "Create Users";
}
</script>

<template>
    <Base>
        <template #title>
            <Header :title="header()" />
        </template>

        <template #admin>
            <div class="container mx-auto p-6 md:p-0 md:w-3/4">
                <Create />
            </div>
        </template>
    </Base>
</template>
