<template>
    <Base>
        <template #title>
            <Header :title="title" />
        </template>

        <template #admin>
            <div class="container mx-auto px-6">
                <Index :order="order" :columns="columns" />
            </div>
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Header from "../../../Components/Master/Admin/Header.vue";
import Index from "../../../Components/Admin/Orders/Pages/Index.vue";

export default {
    components: {
        Base,
        Header,
        Index,
    },
    props: ["order", "columns"],
    data() {
        return {
            title: "Orders",
        };
    },
};
</script>
