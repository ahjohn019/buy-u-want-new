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
            >
                <Carousel />
            </div>
            <br />
            <div class="container mx-auto px-8">
                <Categories />
                <br />
                <hr />
                <br />
                <div data-aos="zoom-in" data-aos-duration="1000">
                    <Featured />
                </div>
                <br />
                <hr />
                <br />
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4"
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
