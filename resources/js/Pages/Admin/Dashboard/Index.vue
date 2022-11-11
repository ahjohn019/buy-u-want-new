<template>
    <Base>
        <template #title>
            <Header :title="title" />
        </template>
        <template #admin>
            <Dashboard />
        </template>
    </Base>
</template>

<script>
import Dashboard from "../../../Components/Admin/Dashboard/Pages/Dashboard.vue";
import Header from "../../../Components/Master/Admin/Header.vue";
import Base from "../Base.vue";

export default {
    components: {
        Dashboard,
        Base,
        Header,
    },
    data() {
        return {
            title: "Dashboards",
        };
    },
};
</script>
