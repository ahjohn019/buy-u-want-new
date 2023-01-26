<template>
    <div class="flex items-center test md:hidden" id="navBar">
        <n-dropdown trigger="click" :options="options">
            <n-button
                ><n-icon
                    ><font-awesome-icon
                        icon="fa-solid fa-bars"
                        class="fa-lg" /></n-icon
            ></n-button>
        </n-dropdown>
    </div>
</template>

<script>
export default {
    props: ["options", "responsive"],
};
</script>
