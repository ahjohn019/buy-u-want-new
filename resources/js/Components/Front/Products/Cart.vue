<template>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div
            class="border rounded-lg p-3 text-center grid grid-cols-3 gap-4 col-span-2 md:col-auto"
        >
            <div>
                <button @click="decrement">
                    <font-awesome-icon icon="fa-solid fa-minus" />
                </button>
            </div>
            <div>
                {{ quantity }}
            </div>
            <div>
                <button @click="increment">
                    <font-awesome-icon icon="fa-solid fa-plus" />
                </button>
            </div>
        </div>
        <div
            class="border rounded-lg p-3 text-center text-sm font-bold col-span-2 hover:bg-gray-300 hover:text-white"
        >
            <button @click="addCart">Add To Cart</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            quantity: 1,
        };
    },
    props: ["products"],
    methods: {
        decrement() {
            if (this.quantity > 1) this.quantity--;
        },
        increment() {
            this.quantity++;
        },
        addCart() {
            this.$inertia.post(route("cart.add", this.products.id), {
                cartQty: this.quantity,
            });
        },
    },
};
</script>
