<template>
    <div class="flex space-x-1">
        <Show :showDetails="showDetails" />
        <Archive :showDetails="showDetails" :paramsApi="paramsApi" />
    </div>
</template>

<script>
import Show from "./Show.vue";
import Archive from "./Archive.vue";

export default {
    components: {
        Show,
        Archive,
    },
    data() {
        return {
            showDetails: this.params.data,
            paramsApi: this.params.api,
        };
    },
    // mounted() {
    //     const test = this.params.api.getModel().rowsToDisplay;
    //     test.splice(1, 1);
    // },
};
</script>
