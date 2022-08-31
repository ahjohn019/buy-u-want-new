<template>
    <div class="container mx-auto" style="width:1000px; margin-top:2.5em;">
        <div class="grid grid-cols-2 gap-4">
            <div class="border rounded-lg m-auto">
                <img src="../../../../images/addidas_duramo.png" alt="" style="width:100%;" />
            </div>
            <div class="space-y-2 flex flex-col justify-center">
                <div class="flex justify-between items-center">
                    <p class="text-4xl font-bold h-10">{{ products.name }}</p>
                    <div class="border rounded-full p-2">
                        <font-awesome-icon icon="fa-solid fa-star" class="fa-xl" />
                    </div>
                </div>
                <p class="text-lg">{{ category.name }}</p>
                <p class="text-3xl"> RM {{ products.price }}</p>
                <div class="flex space-x-2">
                    <div v-for="variant in variants" :key="variant.id">
                        <p>{{ variant.name }}</p>
                    </div>
                </div>
                <Cart :products="products"/>
            </div>
        </div>
        <br>
        <Details :products="products" />
    </div>
</template>

<script>
    import Details from "../Products/Details.vue";
    import Cart from "../Products/Cart.vue";

    export default{
        components: {
            Details,
            Cart
        },

        data(){
            return{
                quantity: 0
            }
        },
        props:['products','category','variants'],
        methods: {
            decrement(){
                if(this.quantity > 0) this.quantity--;
            },
            increment(){
                this.quantity++;
            }
        }
    }
</script>