<template>
    <div v-for="(color, index) in form.variants.colors" :key="index">
        <input
            v-model="color.colors"
            type="color"
            @change="addColor(color.colors, index)"
        />
        <button @click="removeColor(index)" v-show="index != 0">Remove</button>
    </div>
</template>

<script>
export default {
    props: ["form"],
    methods: {
        addColor(color, index) {
            const colorList = Object.keys(this.form.variants.colors);
            const colorKeysInt = colorList.map(Number);

            if (!colorKeysInt.includes(index + 1)) {
                this.form.variants.colors.push({
                    colors: color,
                });
            }

            this.form.variants.colors[index].colors = color;
        },
        removeColor(index) {
            this.form.variants.colors.splice(index, 1);
        },
    },
};
</script>
