<template>
    <Base>
        <template #title>
            <Header :title="title" />
        </template>

        <template #admin>
            <Create :products="products" :columns="columns" :users="users" />
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Header from "@web/Master/Admin/Header.vue";
import Create from "@web/Admin/Orders/Pages/Create.vue";

export default {
    components: {
        Base,
        Header,
        Create,
    },
    props: ["products", "columns", "users"],
    data() {
        return {
            title: "Create",
        };
    },
};
</script>
