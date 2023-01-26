<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Footer from "@web/Master/Footer.vue";
import NavBar from "@web/Master/NavBar.vue";
import Session from "@web/Master/Session.vue";

defineProps(["auth", "roles"]);
</script>
<template>
    <Head title="Index" />
    <div class="min-h-screen flex flex-col bg-gray-100">
        <NavBar :auth="auth" :roles="roles" />
        <Session />
        <slot name="content"></slot>
        <Footer />
    </div>
</template>
