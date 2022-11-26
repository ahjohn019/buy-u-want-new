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
                <label for="address">Address</label>
                <input
                    type="text"
                    class="w-full rounded"
                    v-model="users.address.line1"
                />
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
export default {
    props: ["users"],
};
</script>
