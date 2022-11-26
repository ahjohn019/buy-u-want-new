<template>
    <div>
        <n-dropdown trigger="click" :options="options" @select="handleSelect">
            <n-button>Collect Payment</n-button>
        </n-dropdown>
        <n-modal v-model:show="showModal">
            <n-card
                style="width: 600px"
                title="Credit Card"
                :bordered="false"
                size="huge"
                role="dialog"
                aria-modal="true"
            >
                <PaymentForm :selectedRows="selectedRows" :total="total" />
            </n-card>
        </n-modal>
    </div>
</template>

<script>
import { NDropdown, NButton, NModal, NCard } from "naive-ui";
import { defineComponent, ref } from "vue";
import PaymentForm from "../Draft/Form/Payment.vue";

export default defineComponent({
    components: {
        NDropdown,
        NButton,
        NModal,
        NCard,
        PaymentForm,
    },
    props: ["selectedRows", "total"],
    data() {
        return {
            options: [],
            showModal: ref(false),
        };
    },

    mounted() {
        this.options = [
            {
                label: "Mark As Paid",
                key: "markPaid",
            },
            {
                label: "Enter Credit Card",
                key: "enterCreditCard",
            },
        ];
    },
    methods: {
        handleSelect(key) {
            if (key == "enterCreditCard") {
                this.showModal = ref(true);
            }
        },
    },
});
</script>
