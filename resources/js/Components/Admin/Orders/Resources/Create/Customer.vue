<template>
    <div>
        <multiselect
            v-model="value"
            :options="customerSelection"
            :custom-label="nameWithLang"
            placeholder="Select one"
            label="name"
            track-by="name"
            @select="handleUser($event)"
            @remove="handleRemoveUser($event)"
        ></multiselect>

        <div v-if="value !== null" class="border mt-4 p-4 font-bold" style="">
            <h3 class="border-b-2 p-2">Customer</h3>

            <div class="mt-4 space-y-3">
                <div>
                    <label
                        for="name"
                        class="bg-green-600 text-white py-1 px-2 rounded"
                        >Name</label
                    >
                    <p class="mt-2">{{ value.name }}</p>
                </div>
                <div>
                    <label
                        for="email"
                        class="bg-green-600 text-white py-1 px-2 rounded"
                        >Email</label
                    >
                    <p class="mt-2">{{ value.email }}</p>
                </div>
                <div>
                    <label
                        for="created_at"
                        class="bg-green-600 text-white py-1 px-2 rounded"
                        >Created At</label
                    >
                    <p class="mt-2">{{ value.created_at }}</p>
                </div>
                <div>
                    <label
                        for="Address"
                        class="bg-green-600 text-white py-1 px-2 rounded"
                        >Address</label
                    >

                    <div class="mt-2">
                        <n-collapse>
                            <n-collapse-item title="Details" name="1">
                                <div
                                    v-for="(address, index) in value.address"
                                    :key="index"
                                >
                                    <div class="my-2">
                                        <label
                                            :for="'address_' + index"
                                            class="bg-green-600 text-white py-1 px-2 rounded"
                                            >Address {{ index + 1 }}</label
                                        >
                                        <div class="mt-2">
                                            <p>
                                                {{ address.address_line_one }}
                                            </p>
                                            <p>
                                                {{ address.address_line_two }}
                                            </p>
                                            <p>{{ address.postcode }}</p>
                                            <p>{{ address.city }}</p>
                                            <p>{{ address.state }}</p>
                                            <p>{{ address.country }}</p>
                                        </div>
                                    </div>
                                </div>
                            </n-collapse-item>
                        </n-collapse>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import { NCollapse, NCollapseItem } from "naive-ui";

export default {
    components: {
        Multiselect,
        NCollapse,
        NCollapseItem,
    },
    props: ["users"],
    emits: ["handleUserSelected"],
    data() {
        return {
            value: null,
            customerSelection: this.users,
        };
    },
    methods: {
        handleUser(selected) {
            this.$emit("handleUserSelected", {
                selectUser: selected,
                displayUser: true,
            });
        },
        nameWithLang({ name, email }) {
            return `${name} — ${email}`;
        },
        handleRemoveUser(selected) {
            this.$emit("handleUserSelected", {
                selectUser: selected,
                displayUser: false,
            });
        },
    },
};
</script>
