<template>
    <n-space>
        <Show :parameter="parameter" />
        <Edit :parameter="parameter" :status="status" />
        <Delete :parameter="parameter" />
    </n-space>
</template>

<script>
import Show from "./Show.vue";
import Edit from "./Edit.vue";
import Delete from "./Delete.vue";
export default {
    components: {
        Show,
        Edit,
        Delete,
    },
    data() {
        return {
            parameter: this.params.data,
            status: this.params.status,
        };
    },
};
</script>
