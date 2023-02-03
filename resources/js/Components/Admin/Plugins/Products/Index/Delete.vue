<template>
    <n-button type="error" class="bg-red-600" @click="handleDeleteProduct()"
        >Delete</n-button
    >
</template>

<script>
import Swal from "sweetalert2";
import Custom from "@/CustomSweetAlert";

export default {
    components: {
        Swal,
        Custom,
    },
    props: ["parameter"],
    methods: {
        handleDeleteProduct() {
            Custom.deleteConfirmationMessage().then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(
                        route("products.destroy", this.parameter.products_id),
                        {
                            onSuccess: (response) => {
                                const routeName = "products.admin";
                                const sessionMessage =
                                    response.props.flash
                                        .deleteProductSuccessMessage;
                                Custom.redirectMessage(
                                    sessionMessage,
                                    this.$inertia,
                                    routeName
                                );
                            },
                        }
                    );
                }
            });
        },
    },
};
</script>
