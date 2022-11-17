<template>
    <div
        v-if="deleted"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ deleted }}
        </span>
    </div>
    <div
        v-if="refundSuccess"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ refundSuccess }}
        </span>
    </div>
    <div
        v-if="fulfilled"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ fulfilled }}
        </span>
    </div>
    <div
        v-if="error"
        class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
        role="alert"
    >
        <span class="font-medium">
            {{ error }}
        </span>
    </div>
</template>

<script>
export default {
    computed: {
        deleted() {
            return this.$page.props.flash.orderDeletedMessage;
        },
        fulfilled() {
            return this.$page.props.flash.orderFulFilledMessage;
        },
        refundFailed() {
            return this.$page.props.flash.refundFailedMessage;
        },
        refundSuccess() {
            return this.$page.props.flash.refundSuccessMessage;
        },
        error(){
            return this.$page.props.flash.error;
        }
    },
};
</script>
