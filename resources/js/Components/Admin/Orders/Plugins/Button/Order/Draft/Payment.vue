<template>
    <div>
        <n-dropdown trigger="click" :options="options" @select="handleSelect">
            <n-button>Collect Payment</n-button>
        </n-dropdown>
        <n-modal v-model:show="showModal">
            <form action="">
                <n-card
                    style="width: 600px"
                    title="Credit Card"
                    :bordered="false"
                    size="huge"
                    role="dialog"
                    aria-modal="true"
                >
                    <div class="w-full">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="w-full rounded mt-2" />
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div class="w-full">
                            <label for="cardName">Card Name</label>
                            <input type="text" class="w-full rounded" />
                        </div>
                        <div class="w-full">
                            <label for="cardExpires">Expires</label>
                            <input type="text" class="w-full rounded" />
                        </div>
                        <div class="w-full">
                            <label for="cardCvv">CVV</label>
                            <input type="text" class="w-full rounded" />
                        </div>
                    </div>
                </n-card>
                <n-card
                    style="width: 600px"
                    title="Billing Information"
                    :bordered="false"
                    size="huge"
                    role="dialog"
                    aria-modal="true"
                >
                    <div class="grid grid-cols-3 gap-4">
                        <div>First name</div>
                        <div>Last name</div>
                        <div>Postal code</div>
                        <div>Address</div>
                        <div>Address (Continued)</div>
                        <div>City</div>
                        <div>Country</div>
                        <div>Region</div>
                        <div>Phone</div>
                    </div>
                </n-card>
            </form>
        </n-modal>
    </div>
</template>

<script>
import { NDropdown, NButton, NModal, NCard } from "naive-ui";
import { defineComponent, ref } from "vue";

export default defineComponent({
    components: {
        NDropdown,
        NButton,
        NModal,
        NCard,
    },

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
