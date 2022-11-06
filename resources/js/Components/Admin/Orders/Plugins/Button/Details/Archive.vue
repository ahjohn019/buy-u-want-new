<template>
    <form :action="route('orders.archive')" method="post">
        <input
            type="hidden"
            name="details"
            :value="JSON.stringify(showDetails)"
        />
        <n-button type="error" class="bg-red-600 m-1" attr-type="submit">
            Archive
        </n-button>
    </form>
</template>

<script>
import { NButton } from "naive-ui";

export default {
    components: {
        NButton,
    },
    props: ["showDetails", "paramsApi"],
};
</script>
