<template>
    <form :action="route('orders.refund')" method="post">
        <input
            type="hidden"
            name="selectedRows"
            :value="JSON.stringify(selectedRows)"
        />
        <button
            class="bg-green-600 text-white py-2 px-3 mb-2 hover:bg-green-800 rounded"
            type="submit"
        >
            Refund
        </button>
    </form>
</template>

<script>
export default {
    props: ["selectedRows"],
    data() {
        return {
            archiveList: [],
        };
    },
};
</script>
