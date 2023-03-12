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
            <n-gi :span="2">
                <n-form-item>
                    <div class="w-full flex justify-end">
                        <n-button @click="handleUserEdit" attr-type="button">
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
    props: ["params"],

    setup(props) {
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
                name: props.params.data.fullname,
                email: props.params.data.email,
                role: props.params.data.role,
                gender: genderRef.value,
                birth_date: props.params.data.birthdate,
                home_number: props.params.data.home_number ?? null,
                mobile_number: props.params.data.mobile_number ?? null,
            }),
        };
    },

    methods: {
        handleUserEdit(e) {
            e.preventDefault();
            this.$inertia.put(
                route("users.update", this.params.data.id),
                this.formValue,
                {
                    onError: (error) => {
                        this.error = error;
                    },
                }
            );
        },
    },
});
</script>
