<template>
    <NavBar />
    <p class="text-4xl font-semibold text-center" style="padding:50px 0;">Category</p>
    <div class="container mx-auto grid grid-cols-6 gap-2">
        <Filters />
        <Show />
    </div>

</template>

<script>
    import NavBar from "../../../Components/Master/NavBar.vue";
    import Show from "../../../Components/Front/Category/Show.vue";
    import Filters from "../../../Components/Front/Category/Filters.vue";

    export default {
        components: {
            NavBar,
            Show,
            Filters
        }
    }
</script>