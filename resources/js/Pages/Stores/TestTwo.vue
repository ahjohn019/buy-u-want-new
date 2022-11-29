<script setup>
import { useCounterStore } from "../Stores/TestOne";
import { storeToRefs } from "pinia";
const store = useCounterStore();
const { doubleCount } = storeToRefs(store);
const { increment, decrement } = store;
</script>
<template>
    <h2>{{ doubleCount }}</h2>
    <button @click="increment">count up</button>
    <button @click="decrement('abc')">count down</button>
</template>
