<template>
    <Base>
        <template #admin>
            <div class="container mx-auto px-6">
                <Header :title="title" />
                <Index
                    :products="products"
                    :columns="columns"
                    :maxPrice="maxPrice"
                />
            </div>
        </template>
    </Base>
</template>

<script>
import Base from "../Base.vue";
import Index from "../../../Components/Admin/Products/Pages/Index.vue";
import Header from "../../../Components/Master/Admin/Header.vue";

export default {
    components: {
        Base,
        Index,
        Header,
    },
    props: ["products", "columns", "maxPrice"],
    data() {
        return {
            title: "Products",
        };
    },
};
</script>
