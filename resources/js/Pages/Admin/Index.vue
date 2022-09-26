<template>
    <div>
        <SideBar />
    </div>
</template>

<script>
import SideBar from "../../Components/Master/SideBar.vue";
import Dashboard from "../../Components/Admin/Dashboard/Dashboard.vue";
import AdminFooter from "../../Components/Master/AdminFooter.vue";

export default {
    components: {
        SideBar,
        Dashboard,
        AdminFooter,
    },
};
</script>
