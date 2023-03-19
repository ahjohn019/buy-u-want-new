<template>
    <n-space>
        <Show :params="params" />
        <EditButton :params="params" />
    </n-space>
</template>

<script>
import { defineComponent } from "vue";
import Show from "@admin/User/Button/Show/Button.vue";
import EditButton from "@admin/User/Button/Edit/Button.vue";

export default defineComponent({
    components: {
        Show,
        EditButton,
    },
    props: ["params"],
});
</script>
