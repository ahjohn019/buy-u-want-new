<template>
    <div class="flex flex-col">
        <p class="text-xl text-center md:text-4xl">Latest Product</p>
        <div class="grid grid-cols-2 gap-4 my-2">
            <div
                class="flex flex-col md:flex-row justify-center"
                v-for="(product, index) in products"
                :key="index"
            >
                <div>
                    <img
                        src="../../../../images/addidas_duramo.png"
                        alt=""
                        class="shadow-xl border border-gray-300 rounded-lg"
                        style="width: 150px"
                    />
                </div>
                <div class="py-5 md:p-5">
                    <p class="md:text-2xl font-bold">{{ product.name }}</p>
                    <p class="md:text-sm text-gray-500 font-bold">Addidas</p>
                    <div class="flex justify-between items-center mt-4">
                        <p class="md:text-lg text-gray-500 font-bold">
                            RM {{ product.price }}
                        </p>
                        <div
                            class="bg-blue-400 text-white rounded-xl p-2 ml-2 shadow-xl flex justify-center"
                        >
                            <button
                                type="button"
                                class="flex justify-center items-center space-x-3"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-plus"
                                    class="fa-lg"
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
        };
    },
    mounted() {
        axios.get(route("products.index")).then((response) => {
            this.products = response.data.data;
        });
    },
};
</script>
