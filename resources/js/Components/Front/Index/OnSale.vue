<template>
    <div class="on-sale-container text-center">
        <p class="text-xl md:text-4xl">On Sale</p>
        <swiper
            :slidesPerView="1"
            :loop="true"
            :navigation="true"
            :pagination="{
                clickable: true,
            }"
            :modules="modules"
            class="featured-swiper-list"
        >
            <swiper-slide
                class="featured-slide"
                v-for="(product, index) in products"
                :key="index"
            >
                <Link :href="route('products.show', product.id)">
                    <img
                        src="../../../../images/addidas_duramo.png"
                        alt=""
                        class="shadow-xl border border-gray-300 rounded-lg"
                    />
                </Link>
                <div
                    class="flex justify-between items-center mt-6 w-3/4"
                    style="margin: 1.25rem auto"
                >
                    <Link :href="route('products.show', product.id)">
                        <div class="text-left">
                            <p class="font-bold md:text-3xl">
                                {{ product.name }}
                            </p>
                            <p class="font-bold">RM {{ product.price }}</p>
                        </div>
                    </Link>
                    <div
                        class="bg-green-400 text-white rounded-full p-2 shadow-xl w-10"
                    >
                        <button
                            type="button"
                            class="add-to-cart"
                            @click="addCart(product)"
                        >
                            <font-awesome-icon icon="fa-solid fa-plus" />
                        </button>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";

// import required modules
import { Pagination, Navigation } from "swiper";

import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Swiper,
        SwiperSlide,
        Link,
    },
    setup() {
        return {
            modules: [Navigation, Pagination],
        };
    },
    data() {
        return {
            products: [],
        };
    },
    mounted() {
        axios.get(route("products.index")).then((response) => {
            var getProduct = response.data.data;
            var salesProduct = getProduct.filter(function (product) {
                return JSON.parse(product.tags.toLowerCase()).includes(
                    "onsale"
                );
            });

            this.products = salesProduct;
            console.log(this.products);
        });
    },
    methods: {
        addCart(product) {
            this.$inertia.post(route("cart.add", product.id), {
                cartQty: 1,
            });
        },
    },
};
</script>
