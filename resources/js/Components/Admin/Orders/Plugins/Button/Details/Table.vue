<template>
    <n-table :bordered="false" :single-line="false" size="large">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(order, index) in orderDetails" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ order.product.name }}</td>
                <td>{{ order.product.description }}</td>
                <td>{{ order.product.price }}</td>
                <td>{{ order.product.created_at }}</td>
            </tr>
        </tbody>
    </n-table>
</template>

<script>
import { NTable } from "naive-ui";
import { defineComponent, ref } from "vue";

export default defineComponent({
    components: {
        NTable,
    },
    props: ["orderDetails"],
});
</script>
