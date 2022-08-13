<template>
    <div class="h-screen grid grid-cols-2">
        <Show />
        <ProductInfo />
    </div>
</template>

<script>
    import NavBar from "../../../Components/Master/NavBar.vue";
    import Show from "../../../Components/Front/Checkout/Show.vue";
    import ProductInfo from "../../../Components/Front/Checkout/ProductInfo.vue";

    export default{
        components: {
            NavBar,
            Show,
            ProductInfo
        }
    }
</script>