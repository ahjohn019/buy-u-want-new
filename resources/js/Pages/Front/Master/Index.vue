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
            <Carousel />
            <br />
            <div class="container mx-auto px-8">
                <Categories />
                <br />
                <hr />
                <br />
                <Featured />
                <br />
                <hr />
                <br />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4">
                    <OnSales />
                    <Latest />
                </div>
            </div>
        </template>
    </Base>
</template>
