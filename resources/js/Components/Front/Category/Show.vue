<template>
    <div class="flex">
        <n-collapse class="w-1/4">
            <n-collapse-item title="Colors" name="colors">
                <div class="flex space-x-4">
                    <button
                        class="border rounded-full w-6 h-6 bg-red-500"
                    ></button>
                    <button
                        class="border rounded-full w-6 h-6 bg-blue-500"
                    ></button>
                    <button
                        class="border rounded-full w-6 h-6 bg-yellow-500"
                    ></button>
                    <button
                        class="border rounded-full w-6 h-6 bg-green-500"
                    ></button>
                </div>
            </n-collapse-item>
            <n-collapse-item title="Prices" name="2">
                <n-checkbox-group>
                    <n-grid :y-gap="8" :cols="2">
                        <n-gi>
                            <n-checkbox
                                value="priceOne"
                                label="RM 0 - RM 100"
                            />
                        </n-gi>
                        <n-gi>
                            <n-checkbox
                                value="priceTwo"
                                label="RM 100 - RM 200"
                            />
                        </n-gi>
                        <n-gi>
                            <n-checkbox
                                value="priceThree"
                                label="RM 200 - RM300"
                            />
                        </n-gi>
                        <n-gi>
                            <n-checkbox
                                value="priceFour"
                                label="RM 300 - RM 400"
                            />
                        </n-gi>
                    </n-grid>
                </n-checkbox-group>
            </n-collapse-item>
        </n-collapse>
        <n-scrollbar class="px-4" style="max-height: 650px"
            ><Content
        /></n-scrollbar>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import {
    NCollapse,
    NCollapseItem,
    NScrollbar,
    NCheckboxGroup,
    NCheckbox,
    NGrid,
    NGi,
} from "naive-ui";
import Content from "../../Front/Category/Content.vue";

export default defineComponent({
    components: {
        NCollapse,
        NCollapseItem,
        Content,
        NScrollbar,
        NCheckboxGroup,
        NCheckbox,
        NGrid,
        NGi,
    },
});
</script>
