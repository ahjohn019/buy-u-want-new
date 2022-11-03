<template>
    <div class="border py-4 px-6 shadow mt-4">
        <h2 class="font-bold">Tags</h2>
        <div class="mt-4">
            <VueMultiselect
                v-model="form.tags"
                tag-placeholder="Add this as new tag"
                placeholder="Search or add a tag"
                label="tags"
                track-by="code"
                :options="form.tagsOptions"
                :multiple="true"
                :taggable="true"
                @tag="addTags"
            ></VueMultiselect>
        </div>
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
        addTags(newTags) {
            const tags = {
                tags: newTags,
            };
            this.form.tags.push(tags);
            this.form.tagsOptions.push(tags);
        },
    },
};
</script>
