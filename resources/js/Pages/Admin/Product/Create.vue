<template>
    <Base>
        <template #title>
            <Header :title="title" />
        </template>

        <template #admin>
            <div class="container mx-auto px-6 w-full md:w-4/5">
                <Create :status="status" :category="category" />
            </div>
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Index from "@web/Admin/Products/Index.vue";
import Create from "@web/Admin/Products/Create.vue";
import Header from "@web/Master/Admin/Header.vue";

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
