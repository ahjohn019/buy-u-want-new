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
            <div class="grid grid-cols-1 gap-4">
                <div v-for="(user, userIdx) in userDetails" :key="userIdx">
                    <h2 class="uppercase font-bold">{{ user.title }}</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            v-for="(info, infoIdx) in user.data"
                            :key="infoIdx"
                            class="mt-4"
                        >
                            <label
                                :for="info.title"
                                class="bg-blue-600 text-white font-bold px-2 py-1 rounded uppercase"
                                >{{ info.title }}</label
                            >
                            <div class="mt-2 font-semibold">
                                {{ info.value }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </n-card>
    </n-modal>
</template>

<script>
import { defineComponent, ref } from "vue";
import UserDetails from "@/CustomUserDetails";

export default defineComponent({
  components: {
    UserDetails,
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
          this.userDetails = UserDetails(response);
        });
    },
  },
});
</script>
