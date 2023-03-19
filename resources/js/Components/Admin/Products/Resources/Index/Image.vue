<template>
    <n-image
        v-if="this.images != null"
        :src="'/storage/file/' + this.images"
        object-fit="contain"
        lazy
    />
</template>

<script>
export default {
    data() {
        return {
            images: this.params.value,
        };
    },
};
</script>
