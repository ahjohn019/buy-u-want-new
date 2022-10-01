<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Footer from "../../../Components/Master/Footer.vue";
import NavBar from "../../../Components/Master/NavBar.vue";

defineProps(["auth"]);
</script>
<template>
    <Head title="Index" />
    <div class="min-h-screen flex flex-col">
        <NavBar :auth="auth" />

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
        <slot name="content"></slot>

        <Footer />
    </div>
</template>
