<template>
    <div class="container mx-auto p-4 mt-4 md:w-3/4">
        <div class="grid md:grid-cols-2 gap-4">
            <div class="border rounded-lg m-auto w-1/2 md:w-auto">
                <!-- <img
                    :src="
                        attachments.length <= 0
                            ? '#'
                            : '/storage/file/' + attachments[0].name
                    "
                    alt=""
                    style="width: 100%"
                /> -->
                <img
                    src="../../../../images/addidas_duramo.png"
                    alt=""
                    class="w-full"
                />
            </div>
            <div class="space-y-2 flex flex-col justify-center">
                <div class="flex justify-between my-auto md:m-0">
                    <p
                        class="text-xl md:text-4xl font-bold h-10 flex items-center"
                    >
                        {{ products.name }}
                    </p>
                    <div class="border rounded-full p-2">
                        <font-awesome-icon
                            icon="fa-solid fa-star"
                            class="fa-xl"
                        />
                    </div>
                </div>
                <p class="md:text-lg text-center md:text-left">
                    {{ category.name }}
                </p>
                <p class="md:text-3xl text-center md:text-left">
                    RM {{ products.price }}
                </p>
                <div class="flex space-x-2 justify-center md:justify-start">
                    <div v-for="variant in variants" :key="variant.id">
                        <p>{{ variant.name }}</p>
                    </div>
                </div>
                <Cart :products="products" />
            </div>
        </div>
        <br />
        <Details :products="products" />
    </div>
</template>

<script>
import Cart from "../Products/Cart.vue";
import Details from "../Products/Details.vue";

export default {
    components: {
        Cart,
        Details,
    },

    data() {
        return {
            quantity: 0,
        };
    },
    props: ["products", "category", "variants", "attachments"],
    methods: {
        decrement() {
            if (this.quantity > 0) this.quantity--;
        },
        increment() {
            this.quantity++;
        },
    },
};
</script>
