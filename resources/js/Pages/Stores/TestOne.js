import { defineStore } from "pinia";
export const useCounterStore = defineStore("counter", {
    state: () => ({ count: 0 }),
    getters: {
        doubleCount: (state) => state.count,
    },
    actions: {
        increment() {
            this.count++;
        },
        decrement(value) {
            this.count--;
        },
    },
});
