<template>
    <Base>
        <template #content>
            <div class="container mx-auto md:w-3/4">
                <Cart :cart="cart" :unitPrice="unitPrice" :total="total" />
            </div>
        </template>
    </Base>
</template>

<script>
import NavBar from "../../../Components/Master/NavBar.vue";
import Cart from "../../../Components/Front/Cart/index.vue";
import Footer from "../../../Components/Master/Footer.vue";
import Base from "../Master/Base.vue";

export default {
    components: {
        NavBar,
        Cart,
        Footer,
        Base,
    },
    props: ["cart", "unitPrice", "total"],
};
</script>
