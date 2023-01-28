<template>
    <div class="border py-4 px-6 shadow">
        <h2 class="font-bold">Inventory</h2>
        <div class="mt-4">
            <label for="sku">Sku</label>
            <input
                v-model="form.sku"
                type="text"
                placeholder="Basic Input"
                class="rounded border border-gray-200 w-full"
            />
        </div>
        <div v-if="form.errors.sku">
            {{ form.errors.sku }}
        </div>
    </div>
</template>

<script>
export default {
    props: ["form"],
};
</script>
