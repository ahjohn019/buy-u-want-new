<template>
    <n-space>
        <Show :params="params" />
        <EditButton :params="params" />
    </n-space>
</template>

<script>
import { defineComponent } from "vue";
import Show from "./Show.vue";
import EditButton from "./Edit/Button.vue";

export default defineComponent({
    components: {
        Show,
        EditButton,
    },
    props: ["params"],
});
</script>
