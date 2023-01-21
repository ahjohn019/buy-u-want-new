<template>
    <form @submit.prevent="paymentForm">
        <div
            class="container ml-auto mt-4"
            style="width: 550px; margin-right: 3.5em; margin-top: 3.5em"
        >
            <p class="text-4xl">Buy U Want</p>
            <div class="grid grid-cols-2 mt-4">
                <div class="text-lg">Contact Information</div>
                <div class="text-right">
                    Already have an account? <a href="#">Log in</a>
                </div>
            </div>
            <br />
            <div class="mb-6">
                <input
                    type="text"
                    id="base-input"
                    placeholder="Email or mobile phone number"
                    v-model="form.email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
            </div>
            <p class="text-lg">Shipping Address</p>
            <br />
            <div class="mb-6">
                <select
                    type="text"
                    id="large-input"
                    v-model="form.address.country"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    <option value="malaysia">Malaysia</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-6">
                    <input
                        type="text"
                        id="base-input"
                        placeholder="First Name"
                        v-model="form.first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
                <div class="mb-6">
                    <input
                        type="text"
                        id="base-input"
                        placeholder="Last Name"
                        v-model="form.last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
            </div>
            <div class="mb-6">
                <input
                    type="text"
                    id="large-input"
                    placeholder="Address"
                    v-model="form.address.line1"
                    class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="mb-6">
                    <input
                        type="text"
                        id="base-input"
                        placeholder="Postcode"
                        v-model="form.address.postal_code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
                <div class="mb-6">
                    <input
                        type="text"
                        id="base-input"
                        placeholder="City"
                        v-model="form.address.city"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
                <div class="mb-6">
                    <select
                        type="text"
                        id="large-input"
                        v-model="form.address.state"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option value="selangor">Selangor</option>
                        <option value="kuala_lumpur">Kuala Lumpur</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <input
                    id="default-checkbox"
                    type="checkbox"
                    value=""
                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-200 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                />
                <label
                    for="default-checkbox"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >Save this information for next time</label
                >
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <font-awesome-icon icon="fas fa-angle-left" class="fa-lg" />
                    <Link :href="route('cart.index')" class="ml-2"
                        >Return To Cart</Link
                    >
                </div>
                <div class="text-right">
                    <button
                        type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Continue To Shipping
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: ["authentication", "cart", "unitTotal", "total"],
    data() {
        return {
            cardTest: {
                type: "card",
                card: {
                    number: "4242424242424242",
                    exp_month: 5,
                    exp_year: 2025,
                    cvc: "314",
                },
            },
            form: {
                address: {
                    line1: null,
                    city: null,
                    country: null,
                    state: null,
                    postal_code: null,
                },
                email: this.authentication.email,
                first_name: this.authentication.name,
                last_name: this.authentication.name,
                name: null,
                phone: null,
                cartCheckout: {
                    cart: this.cart,
                    unitTotal: this.unitTotal,
                    total: this.total,
                },
            },
        };
    },
    methods: {
        paymentForm() {
            this.form.name = this.form.first_name + " " + this.form.last_name;
            this.$inertia.post(
                route("stripe.finalPayments", [this.form, this.cardTest]),
                {
                    onSuccess: (res) => {
                        console.log(res);
                    },
                }
            );
        },
    },
};
</script>
