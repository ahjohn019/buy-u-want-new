<template>
    <NavBar />
    <div class="h-screen container mx-auto" style="width:1000px;">
        <Cart :cart="cart" :unitPrice="unitPrice" :total="total"/>
    </div>
    <Footer />

</template>

<script>
    import NavBar from "../../../Components/Master/NavBar.vue";
    import Cart from "../../../Components/Front/Cart/index.vue";
    import Footer from "../../../Components/Master/Footer.vue";

    export default{
        components: {
            NavBar,
            Cart,
            Footer
        },
        props:['cart', 'unitPrice', 'total']
    }
</script>