<template>
    <div>
        <div class="py-6 border-t-2 mt-6">
            <h2>Basic Information</h2>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3">
                <label for="email">Email</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.email"
                />
            </div>
            <div class="col-span-3">
                <label for="fullName">Full Name</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.name"
                />
            </div>
            <div>
                <label for="postal">Postal / Zip Code</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.address.postal_code"
                />
            </div>
            <div class="col-span-2">
                <label class="address">Address</label>
                <multiselect
                    v-model="value"
                    deselect-label="Can't remove this value"
                    :allow-empty="false"
                    track-by="id"
                    label="id"
                    placeholder="Select one"
                    :options="options"
                    :custom-label="nameWithAddress"
                    @select="handleAddress($event)"
                >
                </multiselect>
            </div>
            <div>
                <label for="city">City</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.address.city"
                />
            </div>
            <div>
                <label for="country">Country</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.address.country"
                />
            </div>
            <div>
                <label for="state">State</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.address.state"
                />
            </div>
            <div>
                <label for="phone">Phone</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.phone"
                />
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
    components: {
        Multiselect,
    },
    props: ["users", "selectedUser"],
    data() {
        return {
            value: null,
            options:
                this.selectedUser !== null ? this.selectedUser.address : "",
            addressSelected: {
                postal_code: null,
                state: null,
                country: null,
                city: null,
            },
        };
    },
    methods: {
        handleAddress(event) {
            var address = this.users.address;

            address = {
                ...address,
                line1: event.address_line_one + " " + event.address_line_two,
                postal_code: event.postcode,
                city: event.city,
                country: event.country,
                state: event.state,
            };

            this.users.address = address;
        },
        nameWithAddress({ address_line_one, address_line_two }) {
            return `${address_line_one}` + " " + `${address_line_two}`;
        },
    },
};
</script>
