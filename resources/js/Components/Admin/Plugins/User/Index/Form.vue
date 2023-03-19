<template>
    <n-form ref="formRef" inline :label-width="80" :model="formValue">
        <n-grid x-gap="12" :cols="2">
            <n-gi>
                <n-form-item label="Name" path="user.name">
                    <n-input
                        v-model:value="formValue.name"
                        placeholder="Name"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Email" path="user.email">
                    <n-input
                        v-model:value="formValue.email"
                        placeholder="Email"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Gender" path="user.gender">
                    <n-radio
                        :checked="checkedValue === 'male'"
                        value="male"
                        name="gender"
                        @change="handleChange($event)"
                    >
                        Male
                    </n-radio>
                    <n-radio
                        :checked="checkedValue === 'female'"
                        value="female"
                        name="gender"
                        @change="handleChange($event)"
                    >
                        Female
                    </n-radio>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Birth Date" path="user.birth_date">
                    <n-date-picker
                        v-model:formatted-value="formValue.birth_date"
                        value-format="yyyy-MM-dd"
                        type="date"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Role" path="user.role">
                    <n-select
                        v-model:value="formValue.role"
                        :options="roleOptions"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Home Number" path="user.home_number">
                    <n-input
                        v-model:value="formValue.home_number"
                        placeholder="Home Number"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Mobile Number" path="user.mobile_number">
                    <n-input
                        v-model:value="formValue.mobile_number"
                        placeholder="Mobile Number"
                    />
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Address One" path="user.address_line_one">
                    <n-input
                        v-model:value="formValue.address_line_one"
                        placeholder="Address One"
                    >
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Address Two" path="user.address_line_two">
                    <n-input
                        v-model:value="formValue.address_line_two"
                        placeholder="Address Two"
                    >
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Postcode" path="user.postcode">
                    <n-input
                        v-model:value="formValue.postcode"
                        placeholder="Postcode"
                    >
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="City" path="user.city">
                    <n-input v-model:value="formValue.city" placeholder="City">
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="State" path="user.state">
                    <n-input
                        v-model:value="formValue.state"
                        placeholder="State"
                    >
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi>
                <n-form-item label="Country" path="user.country">
                    <n-input
                        v-model:value="formValue.country"
                        placeholder="Country"
                    >
                    </n-input>
                </n-form-item>
            </n-gi>
            <n-gi :span="2">
                <n-form-item>
                    <div class="w-full flex justify-end">
                        <n-button @click="handleUserSubmit" attr-type="button">
                            Submit
                        </n-button>
                    </div>
                </n-form-item>
            </n-gi>
        </n-grid>
    </n-form>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
    props: ["params", "showModal"],

    setup() {
        const genderRef = ref("male");

        return {
            checkedValue: genderRef,
            role: ref(null),
            handleChange(e) {
                genderRef.value = e.target.value;
            },
            roleOptions: [
                {
                    label: "Admin",
                    value: "admin",
                },
                {
                    label: "User",
                    value: "user",
                },
            ],
            formValue: ref({
                name: "",
                email: "",
                role: "",
                gender: genderRef.value,
                birth_date: null,
                home_number: "",
                mobile_number: "",
                address_line_one: "",
                address_line_two: "",
                postcode: "",
                city: "",
                state: "",
                country: "",
            }),
        };
    },

    created() {
        if (this.params != "create") {
            this.getShowUserDetails();
        }
    },

    methods: {
        getShowUserDetails() {
            axios
                .get(route("users.show", this.params.data.id))
                .then((response) => {
                    const { name, email, biography } = response.data.user;

                    this.formValue = {
                        ...this.formValue,
                        name,
                        email,
                        role: biography?.role,
                        gender: biography?.gender,
                        birth_date: biography?.birth_date,
                        home_number: biography?.home_number,
                        mobile_number: biography?.mobile_number,
                        address_line_one: biography?.address_line_one,
                        address_line_two: biography?.address_line_two,
                        postcode: biography?.postcode,
                        city: biography?.city,
                        state: biography?.state,
                        country: biography?.country,
                    };
                });
        },

        handleUserSubmit(e) {
            e.preventDefault();

            if (this.params != "create") {
                return this.$inertia.put(
                    route("users.update", this.params.data.id),
                    this.formValue,
                    {
                        onError: (error) => {
                            this.error = error;
                        },
                    }
                );
            }

            return this.$inertia.post(route("users.store"), this.formValue, {
                onError: (error) => {
                    this.error = error;
                },
            });
        },
    },
});
</script>
