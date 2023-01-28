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
    >
        <swiper-slide v-for="(p, idx) in path" :key="idx" style="height: 700px">
            <n-image
                :key="idx"
                lazy
                :src="p.name"
                style="width: 100%"
            ></n-image>
        </swiper-slide>
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

import "@custom-css/customStyle.css";

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
            path: [],
        };
    },
    created() {
        this.path = [
            { name: "https://picsum.photos/1000/1000" },
            { name: "https://picsum.photos/1200/1000" },
            { name: "https://picsum.photos/1300/1000" },
        ];
    },
};
</script>
