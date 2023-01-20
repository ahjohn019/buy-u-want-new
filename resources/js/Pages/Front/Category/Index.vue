<template>
    <Base>
        <template #content>
            <div class="container mx-auto p-4">
                <p class="text-4xl font-semibold py-6">Category</p>
                <Show />
            </div>
        </template>
    </Base>
</template>

<script>
import Show from "@web/Front/Category/Show.vue";
import Base from "@master-pages/Base.vue";

export default {
    components: {
        Show,
        Base,
    },
};
</script>
