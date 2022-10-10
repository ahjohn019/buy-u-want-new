<template>
    <form @submit.prevent="submit">
        <div class="px-6 grid md:grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="grid grid-cols-1 gap-4">
                    <div class="border py-4 px-6 shadow">
                        <h2 class="font-bold">Basic Information</h2>
                        <div class="mt-4">
                            <div class="grid grid-cols-1 gap-2 py-2">
                                <div>
                                    <label for="name">Name</label>
                                </div>
                                <div>
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Basic Input"
                                        class="rounded border border-gray-200 w-full"
                                    />
                                </div>
                                <div v-if="form.errors.name">
                                    {{ form.errors.name }}
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 py-2">
                                <div>
                                    <label for="description">Description</label>
                                </div>
                                <div>
                                    <editor
                                        :init="{
                                            plugins:
                                                'lists link image table code help wordcount',
                                        }"
                                        v-model="form.description"
                                    />
                                </div>
                                <div v-if="form.errors.description">
                                    {{ form.errors.description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border py-4 px-6 shadow">
                        <h2 class="font-bold">Pricing</h2>
                        <div class="mt-4">
                            <label for="price">Price</label>
                            <input
                                v-model="form.price"
                                type="number"
                                placeholder="Basic Input"
                                class="rounded border border-gray-200 w-full"
                            />
                            <div v-if="form.errors.price">
                                {{ form.errors.price }}
                            </div>
                        </div>
                    </div>
                    <div class="border py-4 px-6 shadow">
                        <h2 class="font-bold">Inventory</h2>
                        <div class="mt-4">
                            <label for="sku">Sku</label>
                            <input
                                v-model="form.sku"
                                type="text"
                                placeholder="Basic Input"
                                class="rounded border border-gray-200 w-full"
                            />
                        </div>
                        <div v-if="form.errors.sku">
                            {{ form.errors.sku }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 md:col-auto">
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
                <div class="border py-4 px-6 shadow mt-4">
                    <h2 class="font-bold">Category</h2>
                    <div class="mt-4">
                        <VueMultiselect
                            v-model="form.category_id"
                            :options="form.categoryOptions"
                            :searchable="false"
                            placeholder="Category"
                        ></VueMultiselect>
                    </div>
                    <div v-if="form.errors.category_id">
                        {{ form.errors.category_id }}
                    </div>
                </div>
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
import Editor from "@tinymce/tinymce-vue";
import VueMultiselect from "vue-multiselect";

export default defineComponent({
    components: {
        editor: Editor,
        VueMultiselect,
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
