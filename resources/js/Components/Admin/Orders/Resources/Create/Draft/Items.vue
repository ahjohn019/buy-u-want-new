<template>
    <div class="py-3">
        <h2>Order Details</h2>
    </div>
    <n-collapse default-expanded-names="1" accordion>
        <n-collapse-item title="Show" name="1">
            <div>
                <n-scrollbar style="max-height: 300px">
                    <n-table :bordered="false" :single-line="false">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr
                                v-for="(selected, index) in selectedRows"
                                :key="index"
                            >
                                <td>
                                    <div>
                                        <div class="font-bold">
                                            {{ selected.name }}
                                        </div>
                                        <div>
                                            {{ selected.sku }}
                                        </div>
                                        <div>MYR {{ selected.price }}</div>
                                    </div>
                                </td>
                                <UnitTotal
                                    :selected="selected"
                                    :index="index"
                                    @unitTotalSelected="unitTotalSelected"
                                />
                                <td>
                                    <div>
                                        <n-button
                                            attr-type="button"
                                            @click="handleDelete(index)"
                                            type="error"
                                            class="bg-red-600"
                                        >
                                            Delete
                                        </n-button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </n-table>
                </n-scrollbar>
            </div>
            <div class="flex justify-between my-4 font-bold items-center">
                <div>
                    <p class="text-2xl">Total</p>
                </div>
                <div class="flex items-center">
                    <label for="myrCurrency">MYR</label>
                    <span class="text-2xl ml-2">{{ finalAmount }}</span>
                </div>
            </div>
        </n-collapse-item>
    </n-collapse>
</template>

<script>
import {
    NCollapse,
    NCollapseItem,
    NTable,
    NScrollbar,
    NButton,
} from "naive-ui";
import { defineComponent } from "vue";
import UnitTotal from "./UnitTotal.vue";

export default defineComponent({
    components: {
        NCollapse,
        NCollapseItem,
        NTable,
        UnitTotal,
        NScrollbar,
        NButton,
    },
    props: ["selectedRows", "total"],
    emits: ["finalAmount"],
    data() {
        return {
            finalAmount: this.total,
        };
    },
    mounted() {
        this.selectedRows.map((el) => (el.unitTotal = el.price));
        this.selectedRows.map((el) => (el.quantity = 1));
    },
    methods: {
        calculateAmount() {
            const unitTotalList = this.selectedRows.map((el) => el.unitTotal);
            this.finalAmount = unitTotalList.reduce((a, b) => a + b, 0);
            return this.finalAmount;
        },
        handleDelete(index) {
            this.selectedRows.splice(index, 1);
            this.calculateAmount();
        },
        unitTotalSelected() {
            this.$emit("finalAmount", {
                amount: this.calculateAmount(),
            });
        },
    },
});
</script>
