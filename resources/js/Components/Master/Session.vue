<template>
    <div
        v-if="$page.props.flash.checkoutSuccessMessage"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.checkoutSuccessMessage }}
        </span>
    </div>
    <div
        v-if="$page.props.flash.loginSuccessMessage"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.loginSuccessMessage }}
        </span>
    </div>
</template>
