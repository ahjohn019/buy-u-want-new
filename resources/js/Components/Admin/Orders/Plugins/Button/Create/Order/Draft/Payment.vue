<template>
    <div>
        <n-dropdown trigger="click" :options="options" @select="handleSelect">
            <n-button>Collect Payment</n-button>
        </n-dropdown>
        <n-modal v-model:show="showModal">
            <n-card
                style="width: 600px"
                title="Enter Credit Card"
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
import { defineComponent, ref, computed } from "vue";
import PaymentForm from "../Draft/Form/Payment.vue";
import Swal from "sweetalert2";
import Custom from "@/custom";

export default defineComponent({
    components: {
        NDropdown,
        NButton,
        NModal,
        NCard,
        PaymentForm,
    },
    props: ["selectedRows", "total", "selectedUser"],
    inject: ["displayUser"],
    data() {
        return {
            options: [],
            showModal: ref(false),
        };
    },
    provide() {
        return {
            selected: computed(() => this.selectedUser),
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
                if (!this.selectedUser || this.displayUser != true) {
                    Swal.fire(Custom.customerMissing());
                }

                if (this.selectedRows.length <= 0) {
                    Swal.fire(Custom.productEmpty());
                }

                if (
                    !this.selectedUser ||
                    this.selectedRows.length <= 0 ||
                    this.displayUser != true
                ) {
                    this.showModal = ref(false);
                    return this.showModal;
                }

                this.showModal = ref(true);
            }
        },
    },
});
</script>
