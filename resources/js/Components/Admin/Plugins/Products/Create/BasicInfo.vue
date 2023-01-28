<template>
    <div class="border py-4 px-6 shadow">
        <h2 class="font-bold">Basic Information</h2>
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-2 py-2">
                <div>
                    <label for="name">Name</label>
                </div>
                <div>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        placeholder="Basic Input"
                        class="rounded border border-gray-200 w-full"
                    />
                </div>
                <div v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="grid grid-cols-1 gap-2 py-2">
                <div>
                    <label for="description">Description</label>
                </div>
                <div>
                    <editor
                        :init="{
                            plugins:
                                'lists link image table code help wordcount',
                        }"
                        v-model="form.description"
                    />
                </div>
                <div v-if="form.errors.description">
                    {{ form.errors.description }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
export default {
    components: {
        editor: Editor,
    },
    props: ["form"],
};
</script>
