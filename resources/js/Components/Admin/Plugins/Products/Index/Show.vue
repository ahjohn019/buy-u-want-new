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
                    <div v-if="key == 'tags'" class="flex">
                        <div
                            v-for="(tag, tagKey) in detail"
                            :key="tagKey"
                            class="border bg-green-600 text-white font-bold px-2 py-1 rounded-xl"
                        >
                            {{ tag }}
                        </div>
                    </div>
                    <div v-else-if="key == 'attachments'">
                        <n-image
                            width="150"
                            :src="'/storage/file/' + detail"
                            object-fit="contain"
                        />
                    </div>
                    <div v-else>
                        <p>{{ detail }}</p>
                    </div>
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
    created() {},
    methods: {
        displayModal() {
            this.showModal = ref(true);

            this.details = {
                name: this.parameter.name,
                description: this.parameter.description,
                category: this.parameter.category.name,
                sku: this.parameter.sku,
                price: this.parameter.price,
                status: this.parameter.status.name,
                tags: JSON.parse(this.parameter.tags),
                created: this.parameter.created_at,
                attachments:
                    this.parameter.attachments.length > 0
                        ? this.parameter.attachments[0].name
                        : null,
            };

            console.log(this.parameter);
        },
    },
});
</script>
