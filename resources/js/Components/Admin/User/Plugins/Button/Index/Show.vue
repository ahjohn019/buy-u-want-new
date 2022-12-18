<template>
    <n-button @click="displayModal()">Show</n-button>
    <n-modal v-model:show="showModal">
        <n-card
            style="width: 600px"
            title="Details"
            :bordered="false"
            size="huge"
            role="dialog"
            aria-modal="true"
        >
            <div class="grid grid-cols-2">
                <div
                    v-for="(details, title) in userDetails"
                    :key="title"
                    class="mt-2"
                    :class="[
                        ['biography', 'address'].includes(title)
                            ? 'col-span-2'
                            : null,
                    ]"
                >
                    <div v-if="['biography', 'address'].includes(title)">
                        <n-collapse>
                            <n-collapse-item :title="title" name="1">
                                <div class="grid grid-cols-2">
                                    <div
                                        v-for="(bio, title) in details"
                                        :key="title"
                                    >
                                        <label
                                            :for="title"
                                            class="bg-blue-600 text-white font-bold px-2 py-1 rounded"
                                            >{{ title }}</label
                                        >
                                        <p class="my-2 font-bold">{{ bio }}</p>
                                    </div>
                                </div>
                            </n-collapse-item>
                        </n-collapse>
                    </div>
                    <div v-else>
                        <label
                            :for="title"
                            class="bg-blue-600 text-white font-bold px-2 py-1 rounded"
                            >{{ title }}</label
                        >
                        <p class="my-2 font-bold">{{ details }}</p>
                    </div>
                </div>
            </div>
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import { NButton, NModal, NCard, NCollapse, NCollapseItem } from "naive-ui";

export default defineComponent({
    components: {
        NModal,
        NCard,
        NButton,
        NCollapse,
        NCollapseItem,
    },
    props: ["params"],
    setup() {
        const userDetails = ref([]);

        return {
            userDetails,
            showModal: ref(false),
        };
    },
    methods: {
        displayModal() {
            this.showModal = true;
            axios
                .get(route("users.show", this.params.data.id))
                .then((response) => {
                    this.userDetails = response.data.user;
                    this.userDetails.address = response.data.user.address.map(
                        (addr) =>
                            addr.address_line_one +
                            " " +
                            addr.address_line_two +
                            " " +
                            addr.postcode +
                            " " +
                            addr.city +
                            " " +
                            addr.country
                    );
                });
        },
    },
});
</script>
