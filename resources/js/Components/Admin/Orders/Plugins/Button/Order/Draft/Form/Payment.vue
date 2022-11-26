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
                    line1: "332, Jalan E4",
                    city: "abc",
                    country: "abc",
                    state: "abc",
                    postal_code: "53100",
                },
                email: "xxjohn019xx@gmail.com",
                name: "abc123",
                phone: "0192140561",
                draft: {
                    cart: this.selectedRows,
                    total: this.total,
                },
            },

            errors: [],
            handleQuantity: false,
        };
    },
    methods: {
        updateFinalAmount(value) {
            this.handleQuantity = true;

            this.selectedRows.map((el, index) => {
                el.quantity = value.quantity[index];
            });

            this.users.draft.total = value.amount;
        },
        submit() {
            if (this.handleQuantity === false) {
                this.selectedRows.map((el) => {
                    el.quantity = 1;
                });
            }

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
