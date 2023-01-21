<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import NavBar from "@web/Master/NavBar.vue";
import Carousel from "@web/Front/Index/Carousel.vue";
import Categories from "@web/Front/Index/Categories.vue";
import Featured from "@web/Front/Index/Featured.vue";
import OnSales from "@web/Front/Index/OnSale.vue";
import Latest from "@web/Front/Index/Latest.vue";
import Footer from "@web/Master/Footer.vue";
import Base from "./Base.vue";

defineProps(["auth"]);
</script>

<template>
    <Base :auth="auth">
        <template #content>
            <div
                data-aos="fade-right"
                data-aos-delay="50"
                data-aos-duration="1000"
                class="pb-8"
            >
                <Carousel />
            </div>
            <div class="container mx-auto px-8 space-y-6">
                <div class="border-b-2 pb-4">
                    <Categories />
                </div>
                <div
                    class="border-b-2"
                    data-aos="zoom-in"
                    data-aos-duration="1000"
                >
                    <Featured />
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4"
                    data-aos="flip-left"
                    data-aos-duration="1000"
                >
                    <OnSales />
                    <Latest />
                </div>
            </div>
        </template>
    </Base>
</template>
