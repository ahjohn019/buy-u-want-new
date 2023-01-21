<template>
    <div class="col-span-2 flex justify-between">
        <div>
            <label for="addressTitle" class="text-2xl">Address List </label>
        </div>
        <div class="float-right">
            <n-button @click="showModal = true"> Create Address </n-button>
        </div>
    </div>

    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Create Address"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="address_line_one" class="block mb-2"
                        >Address Line 1</label
                    >
                    <input
                        type="text"
                        id="address_line_one"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.address_line_one"
                    />
                </div>
                <div>
                    <label for="address_line_two" class="block mb-2"
                        >Address Line 2</label
                    >
                    <input
                        type="text"
                        id="address_line_two"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.address_line_two"
                    />
                </div>
                <div>
                    <label for="postcode" class="block mb-2">Postcode</label>
                    <input
                        type="text"
                        id="postcode"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.postcode"
                    />
                </div>
                <div>
                    <label for="city" class="block mb-2">City</label>
                    <input
                        type="text"
                        id="city"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.city"
                    />
                </div>
                <div>
                    <label for="state" class="block mb-2">State</label>
                    <input
                        type="text"
                        id="state"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.state"
                    />
                </div>
                <div>
                    <label for="country" class="block mb-2">Country</label>
                    <input
                        type="text"
                        id="country"
                        class="border-gray-300 w-full shadow"
                        v-model="createAddress.country"
                    />
                </div>

                <div class="flex space-x-2 py-2 ml-auto col-span-2">
                    <button
                        type="button"
                        class="border rounded text-white font-bold shadow py-2 px-4 bg-green-500 hover:bg-green-700"
                        @click="submitAddress"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </n-card>
    </n-modal>
</template>

<script>
import { NButton, NModal, NCard } from "naive-ui";
import { defineComponent, ref } from "vue";

export default defineComponent({
    components: {
        NButton,
        NModal,
        NCard,
    },
    props: ["data"],
    data() {
        return {
            showModal: ref(false),
            createAddress: {
                address_line_one: "",
                address_line_two: "",
                postcode: "",
                city: "",
                state: "",
                country: "",
                data: this.data,
            },
        };
    },

    methods: {
        submitAddress() {
            this.$inertia.post(route("address.store"), this.createAddress, {
                onSuccess: (data) => {
                    console.log(data);
                },
                onError: (error) => {
                    console.log(error);
                },
            });
        },
    },
});
</script>
