<template>
    <div class="relative">
        <div
            class="text-lg font-bold w-full z-10 md:flex-row md:flex-nowrap md:justify-between flex items-center"
        >
            <h1>{{ title }}</h1>
        </div>
    </div>
</template>

<script>
export default {
    props: ["title"],
};
</script>
