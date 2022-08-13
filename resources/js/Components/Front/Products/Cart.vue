<template>
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
        <div class="border rounded-lg p-3 text-center font-bold col-span-3 hover:bg-gray-300 hover:text-white">
            <button>
                Add To Cart
            </button>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                quantity:0
            }
        },
        methods:{
            decrement() {
                if (this.quantity > 0) this.quantity--;
            },
            increment() {
                this.quantity++;
            }
        },
    }

</script>