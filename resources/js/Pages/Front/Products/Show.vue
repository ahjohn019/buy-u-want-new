<template>
    <Base>
        <template #content>
            <Show
                :products="products"
                :category="productsCategory"
                :variants="productsVariant"
                :attachments="productsAttachment"
            />
        </template>
    </Base>
</template>

<script>
import NavBar from "@web/Master/NavBar.vue";
import Show from "@web/Front/Products/Show.vue";
import Footer from "@web/Master/Footer.vue";
import Base from "@master-pages/Base.vue";

export default {
    components: {
        NavBar,
        Show,
        Footer,
        Base,
    },

    props: [
        "products",
        "productsCategory",
        "productsVariant",
        "productsAttachment",
    ],
};
</script>
