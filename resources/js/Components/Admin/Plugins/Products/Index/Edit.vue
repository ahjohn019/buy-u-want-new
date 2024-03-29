<template>
    <n-button type="primary" class="bg-green-600" @click="displayModal"
        >Edit</n-button
    >
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Edit Products"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <n-form
                ref="formRef"
                inline
                :label-width="80"
                :model="formValue"
                :size="size"
            >
                <n-grid x-gap="12" :cols="2">
                    <n-gi>
                        <n-form-item label="Name" path="product.name">
                            <n-input
                                v-model:value="formValue.product.name"
                                placeholder="Name"
                            />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item
                            label="Description"
                            path="product.description"
                        >
                            <n-input
                                v-model:value="formValue.product.description"
                                placeholder="Description"
                            />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item
                            label="Categories"
                            path="product.category.categories"
                        >
                            <n-select
                                v-model:value="formValue.product.categories"
                                :options="categoriesList"
                                @update:value="handleUpdateCategory"
                            />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item label="Price" path="product.price">
                            <n-input-number
                                v-model:value="formValue.product.price"
                                clearable
                            />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item label="Sku" path="product.sku">
                            <n-input
                                v-model:value="formValue.product.sku"
                                placeholder="SKU"
                            />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item label="Status" path="product.status">
                            <n-radio
                                :checked="statusChecked === stat.name"
                                @change="handleStatusChange"
                                v-for="stat in status"
                                :key="stat.id"
                                name="status"
                                :value="stat.name"
                                :label="stat.name"
                            >
                            </n-radio>
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-form-item
                            label="attachments"
                            path="product.attachments"
                        >
                            <input type="file" @change="handleUploadChange" />
                        </n-form-item>
                    </n-gi>
                    <n-gi>
                        <n-image
                            width="150"
                            object-fit="contain"
                            :src="
                                isUploadChange === false &&
                                parameter.attachments.length > 0
                                    ? '/storage/file/' +
                                      parameter.attachments[0].name
                                    : attachmentUrl
                            "
                            alt=""
                        />
                    </n-gi>
                    <n-gi :span="2">
                        <n-form-item>
                            <div class="w-full flex justify-end">
                                <n-button
                                    @click="handleProductEdit"
                                    attr-type="button"
                                >
                                    Submit
                                </n-button>
                            </div>
                        </n-form-item>
                    </n-gi>
                </n-grid>
            </n-form>
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import Swal from "sweetalert2";
import Custom from "@/CustomSweetAlert";

export default defineComponent({
    components: {
        Swal,
        Custom,
    },
    data() {
        return {
            showModal: ref(false),
            details: null,
            formValue: ref({
                product: {
                    name: "",
                    description: "",
                    categories: "",
                    price: "",
                    sku: "",
                },
                update: true,
            }),
            size: ref("medium"),
            categoriesList: [],
            statusChecked: this.parameter.status.name,
            attachmentUrl: null,
            isUploadChange: false,
        };
    },
    props: ["parameter", "status"],
    created() {
        this.formValue.product.name = this.parameter.name;
        this.formValue.product.description = this.parameter.description;
        this.formValue.product.categories = ref(this.parameter.category.name);
        this.formValue.product.price = this.parameter.price;
        this.formValue.product.sku = this.parameter.sku;
        this.formValue.product.category_id = this.parameter.category.id;
        this.formValue.product.status = this.parameter.status.name;
        this.formValue.id = this.parameter.id;
    },
    methods: {
        displayModal() {
            this.showModal = ref(true);

            axios.get(route("categories.index")).then((response) => {
                this.categories = response.data.categories;
                this.handleCategoryList(this.categories);
            });
        },
        handleUploadChange(e) {
            this.formValue.attachments = e.target.files[0];
            this.attachmentUrl = URL.createObjectURL(
                this.formValue.attachments
            );
            this.isUploadChange = true;
        },
        handleProductEdit(e) {
            e.preventDefault();
            this.$inertia.put(
                route("products.update", this.parameter.id),
                this.formValue.product,
                {
                    onSuccess: (response) => {
                        const routeName = "products.admin";

                        if (this.isUploadChange == true) {
                            this.$inertia.post(
                                route("attachments.store"),
                                this.formValue
                            );
                        }

                        this.showModal = ref(false);
                        Custom.redirectMessage(
                            response.props.flash.updateProductSuccessMessage,
                            this.$inertia,
                            routeName
                        );
                    },
                    onError: (response) => {
                        console.log(response);
                    },
                }
            );
        },
        handleCategoryList(categories) {
            categories.forEach((el) => {
                this.categoriesList.push({
                    label: el.name,
                    value: el.id,
                });
            });
        },
        handleStatusChange(e) {
            this.statusChecked = e.target.value;
            this.formValue.product.status = this.statusChecked;
        },
        handleUpdateCategory(e) {
            this.formValue.product.category_id = e;
        },
    },
});
</script>
