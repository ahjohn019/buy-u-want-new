<template>
    <div class="border py-4 px-6 shadow mt-4">
        <h2 class="font-bold">Category</h2>
        <div class="mt-4">
            <VueMultiselect
                v-model="form.category_id"
                :options="form.categoryOptions"
                :searchable="false"
                placeholder="Category"
            ></VueMultiselect>
        </div>
        <div v-if="form.errors.category_id">
            {{ form.errors.category_id }}
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
};
</script>
