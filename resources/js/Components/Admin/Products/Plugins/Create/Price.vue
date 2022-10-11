<template>
    <div class="border py-4 px-6 shadow">
        <h2 class="font-bold">Pricing</h2>
        <div class="mt-4">
            <label for="price">Price</label>
            <input
                v-model="form.price"
                type="number"
                placeholder="Basic Input"
                class="rounded border border-gray-200 w-full"
            />
            <div v-if="form.errors.price">
                {{ form.errors.price }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["form"],
};
</script>
