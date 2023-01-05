<template>
    <form
        @submit.prevent="submit"
        class="grid space-y-6 md:space-y-0 md:grid-cols-2 gap-4"
    >
        <div class="grid grid-cols-2 gap-4 border p-6 shadow-lg">
            <div class="col-span-2">
                <h2>Users</h2>
            </div>
            <div>
                <label for="formDataName" class="block mb-2">Name</label>
                <input
                    v-model="formData.name"
                    type="text"
                    class="border-gray-300 focus:ring-0 w-full rounded shadow"
                />
                <div v-if="formData.errors.name">
                    {{ formData.errors.name }}
                </div>
            </div>

            <div>
                <label for="formDataEmail" class="block mb-2">Email</label>
                <input
                    v-model="formData.email"
                    type="email"
                    class="border-gray-300 focus:ring-0 w-full rounded shadow"
                />
                <div v-if="formData.errors.email">
                    {{ formData.errors.email }}
                </div>
            </div>
            <div>
                <label for="formDataPassword" class="block mb-2"
                    >Passwords</label
                >
                <input
                    v-model="formData.password"
                    type="password"
                    class="border-gray-300 focus:ring-0 w-full rounded shadow"
                />
                <div v-if="formData.errors.password">
                    {{ formData.errors.password }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 border p-6 shadow-lg">
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
                        v-model="formData.gender"
                        class="appearance-none checked:bg-blue-500 cursor-pointer mr-1.5"
                    />
                    Male
                </div>
                <div>
                    <input
                        type="radio"
                        name="gender"
                        value="female"
                        v-model="formData.gender"
                        class="appearance-none checked:bg-blue-500 cursor-pointer mr-1.5"
                    />
                    Female
                </div>
                <div v-if="formData.errors.gender" class="col-span-2">
                    {{ formData.errors.gender }}
                </div>
            </div>

            <div>
                <label class="block mb-2">Birth Date</label>
                <input
                    type="date"
                    name="birth_date"
                    v-model="formData.birth_date"
                    class="w-full border-gray-300 rounded shadow cursor-pointer"
                />
                <div v-if="formData.errors.birth_date">
                    {{ formData.errors.birth_date }}
                </div>
            </div>

            <div>
                <label class="block mb-2">Role</label>
                <select
                    name="role"
                    v-model="formData.role"
                    class="border-gray-300 w-full shadow cursor-pointer"
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <div v-if="formData.errors.role">
                    {{ formData.errors.role }}
                </div>
            </div>

            <div>
                <label class="block mb-2">Home Number</label>
                <input
                    type="text"
                    name="home_number"
                    v-model="formData.home_number"
                    class="border-gray-300 w-full shadow"
                />
            </div>

            <div>
                <label class="block mb-2">Phone Number</label>
                <input
                    type="text"
                    name="mobile_number"
                    v-model="formData.mobile_number"
                    class="border-gray-300 w-full shadow"
                />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 border p-6 shadow-lg md:col-span-2">
            <div class="col-span-2">
                <h2>Address</h2>
            </div>
            <div>
                <label for="address_line_one" class="block mb-2"
                    >Address Line 1</label
                >
                <input
                    type="text"
                    id="address_line_one"
                    v-model="formData.address_line_one"
                    class="border-gray-300 w-full shadow"
                />
                <div v-if="formData.errors.address_line_one">
                    {{ formData.errors.address_line_one }}
                </div>
            </div>

            <div>
                <label for="address_line_two" class="block mb-2"
                    >Address Line 2</label
                >
                <input
                    type="text"
                    id="address_line_two"
                    v-model="formData.address_line_two"
                    class="border-gray-300 w-full shadow"
                />
            </div>

            <div>
                <label for="postcode" class="block mb-2">Postcode</label>
                <input
                    type="text"
                    id="postcode"
                    v-model="formData.postcode"
                    class="border-gray-300 w-full shadow"
                />
                <div v-if="formData.errors.postcode">
                    {{ formData.errors.postcode }}
                </div>
            </div>

            <div>
                <label for="city" class="block mb-2">City</label>
                <input
                    type="text"
                    id="city"
                    v-model="formData.city"
                    class="border-gray-300 w-full shadow"
                />
                <div v-if="formData.errors.city">
                    {{ formData.errors.city }}
                </div>
            </div>

            <div>
                <label for="state" class="block mb-2">State</label>
                <input
                    type="text"
                    id="state"
                    v-model="formData.state"
                    class="border-gray-300 w-full shadow"
                />
                <div v-if="formData.errors.state">
                    {{ formData.errors.state }}
                </div>
            </div>

            <div>
                <label for="country" class="block mb-2">Country</label>
                <input
                    type="text"
                    id="country"
                    v-model="formData.country"
                    class="border-gray-300 w-full shadow"
                />
                <div v-if="formData.errors.country">
                    {{ formData.errors.country }}
                </div>
            </div>
        </div>
        <div class="flex space-x-2 py-2">
            <div>
                <button
                    type="submit"
                    class="border rounded text-white font-bold shadow py-2 px-4 bg-green-500 hover:bg-green-700"
                >
                    Submit
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
export default {
    data() {
        return {
            formData: {
                name: "",
                email: "",
                password: "",

                gender: "",
                birth_date: "",
                role: "",
                home_number: "",
                mobile_number: "",

                address_line_one: "",
                address_line_two: "",
                postcode: "",
                city: "",
                state: "",
                country: "",

                errors: [],
            },
        };
    },
    methods: {
        submit() {
            // Submit the form
            this.$inertia.post(route("users.store"), this.formData, {
                onError: (error) => {
                    this.formData.errors = error;
                },
            });
        },
    },
};
</script>
