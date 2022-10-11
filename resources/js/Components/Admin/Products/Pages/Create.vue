<template>
    <form @submit.prevent="submit">
        <div class="px-6 grid md:grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="grid grid-cols-1 gap-4">
                    <BasicInfo :form="form" />
                    <Price :form="form" />
                    <Inventory :form="form" />
                </div>
            </div>
            <div class="col-span-2 md:col-auto">
                <Status :form="form" />
                <Category :form="form" />
            </div>
        </div>
        <div class="px-6 py-4 float-right">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                type="submit"
            >
                Submits
            </button>
        </div>
    </form>
</template>

<script>
import { defineComponent } from "vue";

import VueMultiselect from "vue-multiselect";
import BasicInfo from "../Plugins/Create/BasicInfo.vue";
import Price from "../Plugins/Create/Price.vue";
import Inventory from "../Plugins/Create/Inventory.vue";
import Status from "../Plugins/Create/Status.vue";
import Category from "../Plugins/Create/Category.vue";

export default defineComponent({
    components: {
        VueMultiselect,
        BasicInfo,
        Price,
        Inventory,
        Status,
        Category,
    },
    props: ["status", "category"],
    data() {
        return {
            form: {
                name: null,
                description: null,
                short_description: null,
                price: null,
                sku: null,
                category_id: null,
                status: "active",
                statusOptions: this.status,
                categoryOptions: this.category,
                errors: [],
            },
        };
    },
    methods: {
        submit() {
            for (const [key, value] of Object.entries(this.status)) {
                if (this.form.status == value) {
                    this.form.status = parseInt(key);
                }
            }

            for (const [key, value] of Object.entries(this.category)) {
                if (this.form.category_id == value) {
                    this.form.category_id = parseInt(key);
                }
            }

            this.$inertia.post(route("products.store"), this.form, {
                onSuccess: (page) => {},
                onError: (errors) => {
                    this.form.errors = errors;
                },
            });
        },
    },
});
</script>
