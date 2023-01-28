<template>
    <div
        class="bg-white py-6 px-4 mb-2 md:mr-2 border"
        v-if="products.length > 0"
    >
        <p>Price</p>
        <n-space vertical>
            <form :action="route('products.admin')" method="get">
                <input type="hidden" name="priceRange" :value="value" />
                <n-slider
                    :step="10"
                    :format-tooltip="formatTooltip"
                    :max="maxPrice"
                    :marks="marks"
                    v-model:value="value"
                />
                <n-button attr-type="submit">Filter</n-button>
            </form>
        </n-space>
    </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import {
    NDivider,
    NSlider,
    NSpace,
    NCheckboxGroup,
    NGi,
    NCheckbox,
    NGrid,
    NButton,
} from "naive-ui";

export default defineComponent({
    components: {
        NDivider,
        NSlider,
        NSpace,
        NCheckboxGroup,
        NGi,
        NGrid,
        NCheckbox,
        NButton,
    },
    props: ["products", "columns", "maxPrice"],
    data() {
        return {
            formatTooltip: (value) => `RM ${value}`,
            marks: {},
            value: null,
        };
    },
    mounted() {
        let maxPriceSlider = parseInt(this.maxPrice);
        this.marks = { 0: "0", [maxPriceSlider]: this.maxPrice };
        this.value = ref(this.maxPrice);
    },
});
</script>
