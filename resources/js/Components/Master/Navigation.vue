<template>
    <div class="fixed top-1/2 z-50 right-0 p-4 bg-gray-200 rounded-xl">
        <div v-for="(nav, idx) in navigation" :key="idx" class="py-2">
            <a :href="'#' + nav.name" class="md:text-2xl">
                <font-awesome-icon icon="fas fa-dot-circle" />
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            navigation: [],
        };
    },
    mounted() {
        this.navigation = [
            { name: "carousel" },
            { name: "featured" },
            { name: "latest" },
        ];
    },
};
</script>
