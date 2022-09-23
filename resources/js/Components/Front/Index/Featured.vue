<template>
    <p class="text-xl md:text-4xl text-center">Featured Products</p>
    <swiper
        :slidesPerView="3"
        :spaceBetween="30"
        :loop="true"
        :navigation="true"
        :pagination="{
            clickable: true,
        }"
        :modules="modules"
        :breakpoints="{
            340: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
        }"
        class="featured-swiper-list"
    >
        <swiper-slide class="featured-slide">
            <img
                src="../../../../images/addidas_duramo.png"
                alt=""
                class="shadow-xl border border-gray-300 rounded-lg"
            />
            <div
                class="flex justify-between items-center mt-6"
                style="width: 75%; margin: 1.25rem auto"
            >
                <div class="text-left">
                    <p class="font-bold md:text-3xl">Shoes One</p>
                    <p class="font-bold">RM150</p>
                </div>
                <div
                    class="bg-green-400 text-white rounded-full p-2 shadow-xl"
                    style="width: 2.5em"
                >
                    <button type="button" class="add-to-cart">
                        <font-awesome-icon icon="fa-solid fa-plus" />
                    </button>
                </div>
            </div>
        </swiper-slide>
        <swiper-slide class="featured-slide">
            <img
                src="../../../../images/addidas_duramo.png"
                alt=""
                class="shadow-xl border border-gray-300 rounded-lg" />
            <div
                class="flex justify-between items-center mt-6"
                style="width: 75%; margin: 1.25rem auto"
            >
                <div class="text-left">
                    <p class="font-bold text-3xl">Shoes One</p>
                    <p class="font-bold">RM150</p>
                </div>
                <div
                    class="bg-green-400 text-white rounded-full p-2 shadow-xl"
                    style="width: 2.5em"
                >
                    <button type="button" class="add-to-cart">
                        <font-awesome-icon icon="fa-solid fa-plus" />
                    </button>
                </div></div
        ></swiper-slide>
        <swiper-slide class="featured-slide"></swiper-slide>
        <swiper-slide class="featured-slide"></swiper-slide>
        <swiper-slide class="featured-slide"></swiper-slide>
        <swiper-slide class="featured-slide"></swiper-slide>
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";

// import required modules
import { Pagination, Navigation } from "swiper";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Navigation, Pagination],
        };
    },
};
</script>
