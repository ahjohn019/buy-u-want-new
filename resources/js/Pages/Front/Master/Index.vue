<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import NavBar from '../../../Components/Master/NavBar.vue';
import Carousel from '../../../Components/Front/Index/Carousel.vue';
import Categories from '../../../Components/Front/Index/Categories.vue';
import Featured from '../../../Components/Front/Index/Featured.vue';
import OnSales from '../../../Components/Front/Index/OnSale.vue';
import Latest from '../../../Components/Front/Index/Latest.vue';
import Footer from '../../../Components/Master/Footer.vue';
</script>

<template>

    <Head title="Index" />
    <NavBar />
    <div
        v-if="$page.props.flash.checkoutSuccessMessage"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.checkoutSuccessMessage }}
        </span>
    </div>
    <div
        v-if="$page.props.flash.loginSuccessMessage"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.loginSuccessMessage }}
        </span>
    </div>
    <Carousel />
    <br />
    <Categories />
    <br />
    <hr />
    <br />
    <Featured />
    <br />
    <hr />
    <br />
    <div class="container mx-auto grid grid-cols-2 gap-4" >
        <OnSales />
        <Latest />
    </div>
    <Footer />
</template>