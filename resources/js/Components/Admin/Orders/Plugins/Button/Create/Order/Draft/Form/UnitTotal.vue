<template>
    <td>
        <div class="border rounded-lg p-2 text-center grid grid-cols-3 gap-2">
            <div>
                <button @click="decrement()" type="button">
                    <font-awesome-icon icon="fa-solid fa-minus" />
                </button>
            </div>
            <div>{{ quantity }}</div>

            <div>
                <button @click="increment()" type="button">
                    <font-awesome-icon icon="fa-solid fa-plus" />
                </button>
            </div>
        </div>
    </td>
    <td>
        {{ unitTotal }}
    </td>
</template>

<script>
export default {
    data() {
        return {
            quantity: 1,
            unitTotal: this.selected.price,
        };
    },
    props: ["selected", "index"],
    emits: ["unitTotalSelected"],
    methods: {
        calculateUnitTotal(price, quantity) {
            this.unitTotal = price * quantity;
            this.selected.unitTotal = this.unitTotal;
        },
        decrement() {
            if (this.quantity > 1) this.quantity--;
            this.selected.quantity = this.quantity;
            this.calculateUnitTotal(this.selected.price, this.quantity);
            this.$emit("unitTotalSelected");
        },
        increment() {
            this.quantity++;
            this.selected.quantity = this.quantity;
            this.calculateUnitTotal(this.selected.price, this.quantity);
            this.$emit("unitTotalSelected");
        },
    },
};
</script>
