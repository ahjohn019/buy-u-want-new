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
                <Cart :cart="cart" :unitTotal="unitTotal" :total="total" />
            </div>
        </template>
    </Base>
</template>

<script>
import NavBar from "@web/Master/NavBar.vue";
import Cart from "@web/Front/Cart/index.vue";
import Footer from "@web/Master/Footer.vue";
import Base from "@master-pages/Base.vue";

export default {
    components: {
        NavBar,
        Cart,
        Footer,
        Base,
    },
    props: ["cart", "unitTotal", "total"],
};
</script>
