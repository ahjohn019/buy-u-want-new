<template>
    <div class="h-screen grid grid-cols-2">
        <Show :authentication="authentication" />
        <ProductInfo :cart="cart" :unitPrice="unitPrice" :total="total" />
    </div>
</template>

<script>
import NavBar from "../../../Components/Master/NavBar.vue";
import Show from "../../../Components/Front/Checkout/Show.vue";
import ProductInfo from "../../../Components/Front/Checkout/ProductInfo.vue";

export default {
    components: {
        NavBar,
        Show,
        ProductInfo,
    },
    props: ["cart", "unitPrice", "total", "authentication"],
};
</script>
