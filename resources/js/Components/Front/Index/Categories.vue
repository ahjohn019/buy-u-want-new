<template>
    <div
        class="grid grid-cols-2 lg:grid-cols-4 gap-4"
        data-aos="fade-up"
        data-aos-delay="50"
        data-aos-duration="1000"
    >
        <div
            v-for="category in categories"
            class="m-auto"
            :key="category.id"
            :class="applyColor(category.name)"
        >
            <div class="category-list" v-bind:class="addCategoryColor">
                <p>{{ category.name }}</p>
                <label for="viewAll" class="category-view-all">View All</label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: null,
            addCategoryColor: null,
            colorList: {
                Sneakers: "bg-green-300",
                "Smart Watches": "bg-yellow-300",
                Caps: "bg-red-300",
                Backpacks: "bg-sky-300",
            },
        };
    },
    mounted() {
        try {
            axios
                .get("/categories")
                .then(
                    (response) => (this.categories = response.data.categories)
                );
        } catch (error) {
            console.error(error);
        }
    },
    methods: {
        applyColor(item) {
            this.addCategoryColor = this.colorList[item];
        },
    },
};
</script>
