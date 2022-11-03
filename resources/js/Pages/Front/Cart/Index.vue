<template>
    <Base>
        <template #content>
            <div
                v-if="$page.props.flash.addCartSuccessMessage"
                class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                role="alert"
            >
                <span class="font-medium">
                    {{ $page.props.flash.addCartSuccessMessage }}
                </span>
            </div>
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
