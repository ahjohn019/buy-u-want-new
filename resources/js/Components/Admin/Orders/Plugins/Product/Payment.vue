<template>
    <div class="flex justify-between">
        <div><h2>Total</h2></div>
        <div>
            <h2>RM {{ total }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    props: ["selectedRows", "total"],
};
</script>
