<template>
    <Base>
        <template #admin>
            <div class="container mx-auto px-6 w-full md:w-4/5">
                <Header :title="title" />
                <Create :status="status" :category="category" />
            </div>
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Index from "../../../Components/Admin/Products/Pages/Index.vue";
import Create from "../../../Components/Admin/Products/Pages/Create.vue";
import Header from "../../../Components/Master/Admin/Header.vue";

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
