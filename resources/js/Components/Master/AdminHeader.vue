<template>
    <div class="relative">
        <div
            class="p-6 text-lg font-bold w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-between flex items-center"
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
