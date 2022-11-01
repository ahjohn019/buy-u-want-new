<template>
    <form :action="route('orders.fulfilled')" method="post">
        <input
            type="hidden"
            name="selectedRows"
            :value="JSON.stringify(selectedRows)"
        />
        <button
            class="bg-blue-600 text-white py-2 px-3 mb-2 hover:bg-blue-800 rounded"
            type="submit"
        >
            Mark As Fullfilled
        </button>
    </form>
</template>

<script>
export default {
    props: ["selectedRows"],
    mounted() {
        console.log(this.selectedRows);
    },
    // methods: {
    //     fullfilled() {
    //         this.$inertia.post(route("orders.fulfilled"));
    //     },
    // },
};
</script>
