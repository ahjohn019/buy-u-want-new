<template>
    <Base>
        <template #admin>
            <Dashboard />
        </template>
    </Base>
</template>

<script>
import Dashboard from "../../Components/Admin/Dashboard/Dashboard.vue";
import Base from "./Base.vue";

export default {
    components: {
        Dashboard,
        Base,
    },
};
</script>
