<template>
    <div>
        <multiselect
            v-model="value"
            :options="options"
            :custom-label="nameWithLang"
            placeholder="Select one"
            label="name"
            track-by="name"
        ></multiselect>

        <pre class="language-json"><code>{{ value  }}</code></pre>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";

export default {
    components: {
        Multiselect,
    },
    props: ["users"],
    data() {
        return {
            value: this.users[0],
            options: this.users,
        };
    },
    methods: {
        nameWithLang({ name, email }) {
            return `${name} — ${email}`;
        },
    },
};
</script>
