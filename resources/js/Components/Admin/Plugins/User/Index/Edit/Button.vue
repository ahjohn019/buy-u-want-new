<template>
    <n-button @click="showModal = true"> Edit </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Edit"
            :bordered="false"
            size="medium"
            role="dialog"
            aria-modal="true"
        >
            <Form :params="params" />
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import Form from "./Form.vue";

export default defineComponent({
    components: {
        Form,
    },
    props: ["params"],
    setup() {
        return {
            showModal: ref(false),
        };
    },
});
</script>
