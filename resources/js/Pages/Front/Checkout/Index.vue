<template>
    <div class="h-screen grid md:grid-cols-2">
        <Show
            :cart="cart"
            :unitTotal="unitTotal"
            :total="total"
            :authentication="authentication"
        />
        <ProductInfo :cart="cart" :unitTotal="unitTotal" :total="total" />
    </div>
</template>

<script>
import NavBar from "@web/Master/NavBar.vue";
import Show from "@web/Front/Checkout/Show.vue";
import ProductInfo from "@web/Front/Checkout/ProductInfo.vue";

export default {
    components: {
        NavBar,
        Show,
        ProductInfo,
    },
    props: ["cart", "unitTotal", "total", "authentication"],
};
</script>
