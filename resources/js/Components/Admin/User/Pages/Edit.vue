<template>
    <form
        @submit.prevent="submit"
        class="grid space-y-6 md:space-y-0 md:grid-cols-2 gap-4"
    >
        <div class="grid gap-2 border p-6 shadow-lg col-span-2 md:col-span-1">
            <div>
                <h2>Users</h2>
            </div>
            <div>
                <label for="formDataName" class="block mb-2">Name</label>
                <input
                    type="text"
                    class="border-gray-300 focus:ring-0 w-full rounded shadow"
                    v-model="data.name"
                />
                <div v-if="error.name">
                    {{ error.name }}
                </div>
            </div>

            <div>
                <label for="formDataEmail" class="block mb-2">Email</label>
                <input
                    type="email"
                    class="border-gray-300 focus:ring-0 w-full rounded shadow"
                    v-model="data.email"
                />
            </div>
        </div>
        <div
            class="grid grid-cols-2 gap-4 border p-6 shadow-lg col-span-2 md:col-span-1"
        >
            <div class="col-span-2">
                <h2>Biography</h2>
            </div>

            <div class="grid md:grid-cols-2">
                <div class="col-span-2">
                    <label class="block">Gender</label>
                </div>
                <div>
                    <input
                        type="radio"
                        name="gender"
                        value="male"
                        class="appearance-none checked:bg-blue-500 cursor-pointer mr-1.5"
                        v-model="updateForm.genderChecked"
                    />

                    Male
                </div>
                <div>
                    <input
                        type="radio"
                        name="gender"
                        value="female"
                        class="appearance-none checked:bg-blue-500 cursor-pointer mr-1.5"
                        v-model="updateForm.genderChecked"
                    />

                    Female
                </div>
            </div>

            <div>
                <label class="block mb-2">Birth Date</label>
                <input
                    type="date"
                    name="birth_date"
                    class="w-full border-gray-300 rounded shadow cursor-pointer"
                    v-model="data.biography.birth_date"
                />
            </div>

            <div>
                <label class="block mb-2">Role</label>
                <select
                    name="role"
                    class="border-gray-300 w-full shadow cursor-pointer"
                    v-model="updateForm.roleChecked"
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div>
                <label class="block mb-2">Home Number</label>
                <input
                    type="text"
                    name="home_number"
                    class="border-gray-300 w-full shadow"
                    v-model="data.biography.home_number"
                />
            </div>

            <div>
                <label class="block mb-2">Mobile Number</label>
                <input
                    type="text"
                    name="mobile_number"
                    class="border-gray-300 w-full shadow"
                    v-model="data.biography.mobile_number"
                />
            </div>
        </div>
        <CreateAddressButton :data="data" />
        <div
            class="grid grid-cols-2 gap-4 border p-6 shadow-lg col-span-2"
            v-for="(address, index) in data.address"
            :key="index"
        >
            <div class="my-auto">
                <label
                    :for="'address_' + (index + 1)"
                    class="text-xl font-semibold"
                    >Address {{ index + 1 }}</label
                >
            </div>
            <div class="ml-auto">
                <n-button
                    attr-type="button"
                    type="success"
                    class="bg-green-600"
                    @click="updateAddress(address)"
                >
                    Update
                </n-button>
                <n-button
                    attr-type="button"
                    type="error"
                    class="bg-red-600 ml-2"
                    @click="handleDelete(address)"
                >
                    Delete
                </n-button>
            </div>

            <div>
                <label for="address_line_one" class="block mb-2"
                    >Address Line 1</label
                >
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.address_line_one"
                />
            </div>

            <div>
                <label for="address_line_two" class="block mb-2"
                    >Address Line 2</label
                >
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.address_line_two"
                />
            </div>

            <div>
                <label for="postcode" class="block mb-2">Postcode</label>
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.postcode"
                />
            </div>

            <div>
                <label for="city" class="block mb-2">City</label>
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.city"
                />
            </div>

            <div>
                <label for="state" class="block mb-2">State</label>
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.state"
                />
            </div>

            <div>
                <label for="country" class="block mb-2">Country</label>
                <input
                    type="text"
                    class="border-gray-300 w-full shadow"
                    v-model="address.country"
                />
            </div>
        </div>

        <div class="flex space-x-2 py-2">
            <div>
                <button
                    type="submit"
                    class="border rounded text-white font-bold shadow py-2 px-4 bg-green-500 hover:bg-green-700"
                >
                    Update
                </button>
            </div>
            <div>
                <button
                    type="submit"
                    class="border rounded text-white font-bold shadow py-2 px-4 bg-red-500 hover:bg-red-700"
                >
                    Back To Menu
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { defineComponent, ref } from "vue";
import { NButton, NModal, NCard } from "naive-ui";
import CreateAddressButton from "@admin-plugins/User/Create/Address.vue";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        moment,
        NButton,
        NModal,
        NCard,
        CreateAddressButton,
    },
    data() {
        return {
            updateForm: {
                genderChecked: "male",
                roleChecked: "admin",
                birthDateChecked: "",
            },
            error: [],
            showModal: ref(false),
        };
    },
    props: ["data"],
    mounted() {
        if (this.data.biography != null) {
            this.updateForm.genderChecked = this.data.biography.gender;
            this.updateForm.roleChecked = this.data.biography.role;
        }
    },
    methods: {
        submit() {
            this.data.biography = {
                ...this.data.biography,
                gender: this.updateForm.genderChecked,
                role: this.updateForm.roleChecked,
                home_number: this.data.biography.home_number,
                mobile_number: this.data.biography.mobile_number,
            };

            this.$inertia.put(route("users.update", this.data.id), this.data, {
                onError: (error) => {
                    this.error = error;
                },
            });
        },

        updateAddress(value) {
            this.$inertia.put(route("address.update", value.id), value, {
                onSuccess: (data) => {
                    console.log(data);
                },
            });
        },

        handleDelete(value) {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this resource!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, keep it",
            }).then((result) => {
                if (result.value) {
                    this.$inertia.delete(route("address.destroy", value), {
                        onSuccess: function (result) {
                            Swal.fire(
                                "Deleted!",
                                "Your resource has been deleted.",
                                "success"
                            );
                        },
                    });
                }
            });
        },
    },
});
</script>
