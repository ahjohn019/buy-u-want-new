<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Footer from "../../../Components/Master/Footer.vue";
import NavBar from "../../../Components/Master/NavBar.vue";
import Session from "../../../Components/Master/Session.vue";

defineProps(["auth"]);
</script>
<template>
    <Head title="Index" />
    <div class="min-h-screen flex flex-col">
        <NavBar :auth="auth" />
        <Session />
        <slot name="content"></slot>
        <Footer />
    </div>
</template>
