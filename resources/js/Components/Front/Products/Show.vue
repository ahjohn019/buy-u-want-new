<template>
    <div class="container mx-auto grid grid-cols-2 gap-4 " style="width:1200px; margin-top:2.5em;">
        <div>
            <img src="../../../../images/addidas_duramo.png" alt="" width="550" />
        </div>
        <div class="space-y-2 flex flex-col justify-center">
            <div class="flex justify-between items-center">
                <p class="text-4xl font-bold h-10">{{ products.name }}</p>
                <div class="border rounded-full p-2">
                    <font-awesome-icon icon="fa-solid fa-star" class="fa-xl"/>
                </div>
            </div>
            <p class="text-lg">{{ category.name }}</p>
            <p class="text-3xl"> RM {{ products.price }}</p>
            <div class="flex space-x-2">
                <div v-for="variant in variants" :key="variant.id">
                    <p>{{ variant.name }}</p>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="border rounded-lg p-3 text-center grid grid-cols-3 gap-4">
                    <div>
                        <button v-on:click="decrement">
                            <font-awesome-icon icon="fa-solid fa-minus" />
                        </button>
                    </div>
                    <div>
                        {{ quantity }}
                    </div>
                    <div>
                        <button v-on:click="increment">
                            <font-awesome-icon icon="fa-solid fa-plus" />
                        </button>
                    </div>
                </div>
                <div class="border rounded-lg p-3 text-center col-span-3">
                    <button>
                        Add To Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
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