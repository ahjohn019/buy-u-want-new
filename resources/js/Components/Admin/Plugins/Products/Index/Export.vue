<template>
    <a
        :href="route('exports.index', this.export)"
        class="bg-blue-600 ml-4 text-white py-2 px-3 hover:bg-blue-800 rounded"
        >Export</a
    >
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    data() {
        return {
            export: [],
        };
    },
    props: ["products"],
    created() {
        this.export.push(this.products);
    },
});
</script>
