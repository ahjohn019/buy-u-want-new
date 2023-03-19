<template>
    <form @submit.prevent="submit">
        <div class="px-6 grid md:grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="grid grid-cols-1 gap-4">
                    <input type="hidden" v-model="form.type" />
                    <BasicInfo :form="form" />
                    <Variants :form="form" />
                    <Attachments :form="form" />
                    <Price :form="form" />
                    <Inventory :form="form" />
                </div>
            </div>
            <div class="col-span-2 md:col-auto">
                <Status :form="form" />
                <Category :form="form" />
                <Tags :form="form" />
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
import BasicInfo from "@admin/Products/Resources/Create/BasicInfo.vue";
import Price from "@admin/Products/Resources/Create/Price.vue";
import Inventory from "@admin/Products/Resources/Create/Inventory.vue";
import Status from "@admin/Products/Resources/Create/Status.vue";
import Category from "@admin/Products/Resources/Create/Category.vue";
import Attachments from "@admin/Products/Resources/Create/Attachments.vue";
import Variants from "@admin/Products/Resources/Create/Variants.vue";
import Tags from "@admin/Products/Resources/Create/Tags.vue";

export default defineComponent({
    components: {
        VueMultiselect,
        BasicInfo,
        Price,
        Inventory,
        Status,
        Category,
        Attachments,
        Variants,
        Tags,
    },
    props: ["status", "category"],
    data() {
        return {
            form: {
                type: "create",
                name: null,
                description: null,
                short_description: null,
                price: null,
                sku: null,
                category_id: null,
                status: null,
                statusOptions: this.status,
                categoryOptions: this.category,
                errors: [],
                attachments: null,
                variants: {
                    colors: [{ colors: "" }],
                    sizes: [],
                    sizeOptions: [],
                },
                tags: [],
                tagsOptions: [],
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(route("products.store"), this.form, {
                onError: (errors) => {
                    this.form.errors = errors;
                    console.log(this.form.errors);
                },
            });
        },
    },
});
</script>
