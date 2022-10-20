<template>
    <div>
        <VueMultiselect
            v-model="form.variants.sizes"
            tag-placeholder="Add this as new tag"
            placeholder="Search or add a tag"
            label="sizes"
            track-by="code"
            :options="form.variants.sizeOptions"
            :multiple="true"
            :taggable="true"
            @tag="addSizes"
        ></VueMultiselect>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
export default {
    components: {
        VueMultiselect,
    },
    props: ["form"],
    methods: {
        addSizes(newSizeTags) {
            const sizeTags = {
                sizes: newSizeTags,
            };
            this.form.variants.sizes.push(sizeTags);
            this.form.variants.sizeOptions.push(sizeTags);
        },
    },
};
</script>
