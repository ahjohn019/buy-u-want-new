<template>
    <form @submit.prevent="submit">
        <ItemsForm
            :selectedRows="selectedRows"
            :total="total"
            @finalAmount="updateFinalAmount"
        />
        <CreditCardForm :cardList="cardList" />
        <UserForm :users="users" />
        <n-button
            attr-type="submit"
            type="primary"
            class="bg-green-600 mt-4 float-right"
            :disabled="disabled"
        >
            Submit
        </n-button>
    </form>
</template>

<script>
import { NButton, NCollapse, NCollapseItem } from "naive-ui";
import CreditCardForm from "../Form/CreditCard.vue";
import UserForm from "../Form/Users.vue";
import ItemsForm from "../Form/Items.vue";
import { defineComponent } from "vue";

export default defineComponent({
    components: {
        NButton,
        NCollapse,
        NCollapseItem,
        CreditCardForm,
        UserForm,
        ItemsForm,
    },
    props: ["selectedRows", "total"],
    inject: ["selected"],
    data() {
        return {
            cardList: {
                type: "card",
                card: {
                    number: "4242424242424242",
                    exp_month: 5,
                    exp_year: 2025,
                    cvc: "314",
                },
            },

            users: {
                address: {
                    line1: "",
                    city: "",
                    country: "",
                    state: "",
                    postal_code: "",
                },
                email: this.selected !== null ? this.selected.email : "",
                name: this.selected !== null ? this.selected.name : "",
                phone: "0192140561",
                draft: {
                    cart: this.selectedRows,
                    total: this.total,
                },
            },

            errors: [],
            handleQuantity: false,
            disabled: false,
        };
    },
    mounted() {
        if (this.selectedRows.length <= 0) {
            this.disabled = true;
        }
    },
    methods: {
        updateFinalAmount(value) {
            this.users.draft.total = value.amount;
        },
        submit() {
            this.updateFinalAmount;
            this.$inertia.post(
                route("stripe.finalPayments", [this.users, this.cardList], {
                    onError: (errors) => {
                        this.errors = errors;
                        console.log(this.errors);
                    },
                })
            );
        },
    },
});
</script>
