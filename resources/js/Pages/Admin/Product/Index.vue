<template>
    <Base>
        <template #title>
            <Header :title="title" />
        </template>

        <template #admin>
            <div class="container mx-auto">
                <Index
                    :products="products"
                    :columns="columns"
                    :maxPrice="maxPrice"
                    :status="status"
                />
            </div>
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Index from "@web/Admin/Products/Index.vue";
import Header from "@web/Master/Admin/Header.vue";

export default {
    components: {
        Base,
        Index,
        Header,
    },
    props: ["products", "columns", "maxPrice", "status"],
    data() {
        return {
            title: "Products",
        };
    },
};
</script>
