<template>
    <Base>
        <template #admin>
            <Header :title="title" />
            <Create :status="status" :category="category" />
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Index from "../../../Components/Admin/Products/Index.vue";
import Create from "../../../Components/Admin/Products/Create.vue";
import Header from "../../../Components/Master/AdminHeader.vue";

export default {
    components: {
        Base,
        Index,
        Create,
        Header,
    },
    data() {
        return {
            title: "Create",
        };
    },
    props: ["status", "category"],
};
</script>
