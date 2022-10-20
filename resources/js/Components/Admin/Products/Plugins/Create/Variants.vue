<template>
    <div class="border py-4 px-6 shadow mt-4">
        <h2 class="font-bold">Variant</h2>
        <div class="mt-4">
            <label for="colors">Colors</label>
            <Colors :form="form" />
            <label for="sizes">Size</label>
            <Sizes :form="form" />
        </div>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
import Colors from "./Variants/Colors.vue";
import Sizes from "./Variants/Sizes.vue";

export default {
    components: {
        VueMultiselect,
        Colors,
        Sizes,
    },
    props: ["form"],
};
</script>
