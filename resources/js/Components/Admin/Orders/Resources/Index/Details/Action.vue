<template>
    <div class="flex space-x-1">
        <Show :showDetails="showDetails" />
    </div>
</template>

<script>
import Show from "./Show.vue";

export default {
    components: {
        Show,
    },
    data() {
        return {
            showDetails: this.params.data,
        };
    },
};
</script>
