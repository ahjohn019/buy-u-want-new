<template>
    <n-collapse default-expanded-names="1" accordion>
        <n-collapse-item title="Item Details" name="1">
            <div>
                <n-table :bordered="false" :single-line="false">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="(selected, index) in selectedRows"
                            :key="index"
                            ref="items"
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
                        </tr>
                    </tbody>
                </n-table>
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
import { NCollapse, NCollapseItem, NTable } from "naive-ui";
import { defineComponent } from "vue";
import UnitTotal from "../Form/UnitTotal.vue";

export default defineComponent({
    components: {
        NCollapse,
        NCollapseItem,
        NTable,
        UnitTotal,
    },
    props: ["selectedRows", "total"],
    emits: ["finalAmount"],
    data() {
        return {
            finalAmount: this.total,
        };
    },

    methods: {
        calculateQuantity(value) {
            const quantityList = this.$refs.items.map(function (el) {
                return parseInt(el.cells[1].innerText);
            });
            quantityList[value.index] = value.quantity;
            return quantityList;
        },
        calculateAmount(value) {
            const unitTotalList = this.$refs.items.map((el) =>
                parseInt(el.cells[el.cells.length - 1].innerText)
            );
            unitTotalList[value.index] = value.total;
            this.finalAmount = unitTotalList.reduce((a, b) => a + b, 0);
            return this.finalAmount;
        },
        unitTotalSelected(value) {
            this.$emit("finalAmount", {
                amount: this.calculateAmount(value),
                quantity: this.calculateQuantity(value),
            });
        },
    },
});
</script>
