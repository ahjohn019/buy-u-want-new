<template>
    <form :action="route('orders.create')" method="get">
        <n-button type="info" class="bg-blue-500 mt-1" attr-type="submit">
            Create
        </n-button>
    </form>
</template>

<script>
import { defineComponent } from "vue";
import { NButton } from "naive-ui";

export default defineComponent({
    components: {
        NButton,
    },
});
</script>
