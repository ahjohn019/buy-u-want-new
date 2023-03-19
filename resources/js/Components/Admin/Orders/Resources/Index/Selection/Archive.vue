<template>
    <form :action="route('orders.archive')" method="post">
        <input
            type="hidden"
            name="selected"
            :value="JSON.stringify(selectedRows)"
        />
        <button
            class="bg-red-600 text-white py-2 px-3 mb-2 hover:bg-red-800 rounded"
            type="submit"
            @click="archiveSelected"
        >
            Archive
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
