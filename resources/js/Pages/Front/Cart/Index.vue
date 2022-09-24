<template>
    <NavBar />
    <div class="container mx-auto md:w-3/4">
        <Cart :cart="cart" :unitPrice="unitPrice" :total="total" />
    </div>
    <div class="lg:fixed bottom-0 left-0 right-0">
        <Footer />
    </div>
</template>

<script>
import NavBar from "../../../Components/Master/NavBar.vue";
import Cart from "../../../Components/Front/Cart/index.vue";
import Footer from "../../../Components/Master/Footer.vue";

export default {
    components: {
        NavBar,
        Cart,
        Footer,
    },
    props: ["cart", "unitPrice", "total"],
};
</script>
