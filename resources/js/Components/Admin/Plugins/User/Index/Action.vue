<template>
    <n-space>
        <Show :params="params" />
        <n-button>Edit</n-button>
    </n-space>
</template>

<script>
import { defineComponent } from "vue";
import { NButton, NSpace, NModal, NCard } from "naive-ui";
import Show from "./Show.vue";

export default defineComponent({
    components: {
        NButton,
        NSpace,
        NModal,
        NCard,
        Show,
    },
});
</script>
