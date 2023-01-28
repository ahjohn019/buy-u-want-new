<template>
    <div class="flex justify-end items-center pt-2 space-x-3">
        <form :action="route('orders.search')" method="get">
            <input
                type="text"
                name="orderSearch"
                class="rounded border border-gray-200 outline-none focus:outline focus:transition"
                placeholder="Input Your Order"
            />
            <n-button attr-type="submit" value="search" class="ml-4"
                >Search</n-button
            >
        </form>
        <Create />
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { NButton } from "naive-ui";
import Create from "@admin-plugins/Orders/Index/Selection/Create.vue";

export default defineComponent({
    components: {
        NButton,
        Create,
    },
});
</script>
