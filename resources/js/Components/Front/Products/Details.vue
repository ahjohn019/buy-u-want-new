<template>
    <n-tabs type="line" size="large" justify-content="center" animated>
        <n-tab-pane name="product descriptions" tab="Product Descriptions">
            {{ products.description }}
        </n-tab-pane>
        <n-tab-pane name="product review" tab="Product Review">
            Review
        </n-tab-pane>
    </n-tabs>
</template>

<script>
import { defineComponent } from "vue";
import { NTabPane, NTabs } from "naive-ui";

export default defineComponent({
    components: {
        NTabPane,
        NTabs,
    },
    props: ["products"],
});
</script>
