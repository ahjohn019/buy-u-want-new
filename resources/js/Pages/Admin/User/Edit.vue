<script setup>
import Base from "../Base.vue";
import Header from "../../../Components/Master/Admin/Header.vue";
import Edit from "../../../Components/Admin/User/Pages/Edit.vue";

const props = defineProps(["user"]);

function header() {
    return "Edit Users";
}

function selectedUser() {
    return props.user;
}
</script>

<template>
    <Base>
        <template #title>
            <Header :title="header()" />
        </template>

        <template #admin>
            <div class="container mx-auto p-6 md:p-0 md:w-3/4">
                <Edit :data="selectedUser()" />
            </div>
        </template>
    </Base>
</template>
