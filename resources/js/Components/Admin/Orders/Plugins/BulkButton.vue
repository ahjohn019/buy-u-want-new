<template>
    <button
        class="bg-blue-600 text-white py-2 px-3 mb-2 hover:bg-blue-800 rounded"
        @click="fullfilled()"
    >
        Mark As Fullfilled
    </button>
</template>

<script>
export default {
    props: ["selectedRows"],
    methods: {
        fullfilled() {
            console.log(this.selectedRows);
        },
    },
};
</script>
