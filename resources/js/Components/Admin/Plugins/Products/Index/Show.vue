<template>
    <n-button type="info" class="bg-blue-600" @click="displayModal">
        Show
    </n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Details"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <n-grid x-gap="12" :y-gap="8" :cols="2">
                <n-gi v-for="(detail, key) in details" :key="key">
                    <h3 class="uppercase font-bold">{{ key }}</h3>
                    <p>{{ detail }}</p>
                </n-gi>
            </n-grid>
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
    data() {
        return {
            showModal: ref(false),
            details: null,
        };
    },
    props: ["parameter"],
    methods: {
        displayModal() {
            this.showModal = ref(true);
            this.details = this.parameter;
        },
    },
});
</script>
