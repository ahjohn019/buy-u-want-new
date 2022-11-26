<template>
    <div class="grid grid-cols-5 gap-4">
        <div class="w-full col-span-2">
            <label for="cardNumber">Card Number</label>
            <input
                type="text"
                class="w-full rounded"
                v-model="cardList.card.number"
            />
        </div>
        <div class="w-full col-span-2">
            <label for="cardExpires">Expires</label>
            <div class="flex space-x-1">
                <input
                    type="text"
                    class="w-full rounded"
                    placeholder="month"
                    v-model="cardList.card.exp_month"
                />
                <input
                    type="text"
                    class="w-full rounded"
                    placeholder="year"
                    v-model="cardList.card.exp_year"
                />
            </div>
        </div>
        <div class="w-full">
            <label for="cardCvv">CVV</label>
            <input
                type="text"
                class="w-full rounded"
                v-model="cardList.card.cvc"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: ["cardList"],
};
</script>
