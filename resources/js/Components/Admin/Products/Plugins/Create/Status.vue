<template>
    <div class="border py-4 px-6 shadow w-full">
        <h2 class="font-bold">Status</h2>
        <div class="mt-4">
            <VueMultiselect
                v-model="form.status"
                :options="form.statusOptions"
                :searchable="false"
                placeholder="Status"
            ></VueMultiselect>
        </div>
        <div v-if="form.errors.status">
            {{ form.errors.status }}
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
