<template>
    <swiper
        :spaceBetween="30"
        :effect="'fade'"
        :loop="true"
        :navigation="true"
        :pagination="{
            clickable: true,
        }"
        :modules="modules"
        style="height: 700px"
    >
        <swiper-slide
            ><img src="https://picsum.photos/1000/1000"
        /></swiper-slide>
        <swiper-slide
            ><img src="https://picsum.photos/1200/1000"
        /></swiper-slide>
        <swiper-slide
            ><img src="https://picsum.photos/1300/1000"
        /></swiper-slide>
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/effect-fade";
import "swiper/css/navigation";
import "swiper/css/pagination";

import "../../../../../resources/css/customStyle.css";

// import required modules
import { EffectFade, Navigation, Pagination } from "swiper";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [EffectFade, Navigation, Pagination],
        };
    },
};
</script>
