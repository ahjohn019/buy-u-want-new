<template>
    <div style="margin-top:3.5em;">
        <p class="text-3xl text-center">Shopping Cart</p>
        <table class="table-auto w-full" style="margin-top: 3.5em;">
            <thead class="text-left border-b-2" style="height:3.5em;">
                <th>Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th class="text-right">Total</th>
            </thead>
            <tbody class="border-b-2" style="height:150px;">
                <tr>
                    <td>
                        <div class="flex ">
                            <div class="border drop-shadow-md rounded-lg">
                                <img src="../../../../images/addidas_duramo.png" alt="" width="100">
                            </div>
                            <div class="ml-4">
                                <p class="text-xl font-semibold">Shoes One</p>
                                <p>Addidas</p>
                                <a href="#" class="underline text-sky-500 hover:text-red-500">Remove</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        RM 100
                    </td>
                    <td>
                        <div class="border rounded-lg p-3 text-center grid grid-cols-3 gap-4 w-1/2">
                            <div>
                                <button v-on:click="decrement">
                                    <font-awesome-icon icon="fa-solid fa-minus" />
                                </button>
                            </div>
                            <div>
                                {{quantity}}
                            </div>
                            <div>
                                <button v-on:click="increment">
                                    <font-awesome-icon icon="fa-solid fa-plus" />
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        RM 100
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="float-right my-4" style="width:330px;">
            <div class="grid grid-cols-3 text-center py-4">
                <div class="border-r-2">
                    <font-awesome-icon icon="fa-solid fa-pencil" class="fa-lg" />
                    <p>Note</p>
                </div>
                <div class="border-r-2">
                    <font-awesome-icon icon="fa-solid fa-truck" class="fa-lg" />
                    <p>Shipping</p>
                </div>
                <div>
                    <font-awesome-icon icon="fa-solid fa-money-bill" class="fa-lg" />
                    <p>Coupon</p>
                </div>
            </div>

            <div class="grid grid-cols-3 border-t-2 py-4">
                <div class="col-span-2">
                    <p>Subtotal</p>
                </div>
                <div class="text-right">
                    <p class="font-bold">RM 100</p>
                </div>
            </div>
            <button type="button"
                class="bg-blue-500 text-white w-full hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold text-lg rounded-lg text-sm p-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                quantity: 1
            }
        },
        methods: {
            decrement() {
                if (this.quantity > 1) this.quantity--;
            },
            increment() {
                this.quantity++;
            }
        },
    }
</script>