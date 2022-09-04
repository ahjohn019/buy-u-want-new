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
                <tr v-for="data in cart" :key="data.id">
                    <td>
                        <div class="flex ">
                            <div class="border drop-shadow-md rounded-lg my-4">
                                <img src="../../../../images/addidas_duramo.png" alt="" width="100">
                            </div>
                            <div class="m-4">
                                <p class="text-xl font-semibold">{{data.name}}</p>
                                <p>Addidas</p>
                                <button class="border rounded-lg p-2 bg-red-500 text-white text-center font-bold col-span-3 hover:bg-gray-300 hover:text-white" 
                                        @click="removeCart(data.id)"
                                >
                                    Remove
                                </button>   
                            </div>
                        </div>
                    </td>
                    <td>
                        {{data.price}}
                    </td>
                    <td>
                        <div class="flex">
                            <div class="border rounded-lg p-3 text-center grid grid-cols-3 gap-4 ">
                                <div>
                                    <button @click="decrement(data)">
                                        <font-awesome-icon icon="fa-solid fa-minus" />
                                    </button>
                                </div>
                                <div>
                                    {{data.quantity}}
                                </div>
                                
                                <div>
                                    <button @click="increment(data)">
                                        <font-awesome-icon icon="fa-solid fa-plus" />
                                    </button>
                                </div>
                            </div>
                            <button class="border rounded-lg font-sm p-2 ml-4 bg-blue-500 text-white text-center font-bold col-span-3 hover:bg-gray-300 hover:text-white" 
                                    @click="updateCart(data.quantity, data.id)"
                            >
                                Update
                            </button>
                        </div>
                        
                    </td>
                    <td class="text-right">
                        RM {{ unitPrice[data.id].unitPrice }}
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
                    <p class="font-bold">RM {{ total }}</p>
                </div>
            </div>
            <form :action="route('checkout.index')" method="get">
                <button type="submit"
                    class="bg-blue-500 text-white w-full hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold text-lg rounded-lg text-sm p-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Checkout
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props:['cart', 'unitPrice', 'total'],
        methods: {
            decrement(data) {
                if (data.quantity > 1) data.quantity--;
            },
            increment(data) {
                data.quantity++;
            },
            updateCart(quantity, productId){
                this.$inertia.post(route('cart.update', { quantity: quantity, product : productId  } ))
            },
            removeCart(productId){
                this.$inertia.post(route('cart.remove', { product : productId } ))
            }
        },
    }
</script>