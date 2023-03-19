<template>
    <n-button @click="showModal = true"> Create </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Create"
            :bordered="false"
            size="medium"
            role="dialog"
            aria-modal="true"
        >
            <AdminForm :params="'create'" />
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import AdminForm from "@admin/User/Resources/Form.vue";

export default defineComponent({
    components: {
        AdminForm,
    },
    props: ["params"],
    setup() {
        return {
            showModal: ref(false),
        };
    },
});
</script>
