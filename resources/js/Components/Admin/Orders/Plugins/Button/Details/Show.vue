<template>
    <n-button type="info" class="bg-blue-600 m-1" @click="modalDetails"
        >Show</n-button
    >
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 800px"
            title="Modal"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <Table :orderDetails="orderDetails" />
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import { NButton, NModal, NCard } from "naive-ui";
import Table from "./Table.vue";

export default defineComponent({
    components: {
        NButton,
        NModal,
        NCard,
        Table,
    },
    props: ["showDetails"],
    data() {
        return {
            showModal: ref(false),
            orderDetails: [],
        };
    },

    methods: {
        modalDetails() {
            this.showModal = true;
            axios
                .get(route("orders.show", this.showDetails.number))
                .then((response) => {
                    this.orderDetails = response.data.details;
                });
        },
    },
});
</script>
