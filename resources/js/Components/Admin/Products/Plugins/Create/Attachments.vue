<template>
    <div class="border py-4 px-6 shadow mt-4">
        <h2 class="font-bold">Attachments</h2>

        <div class="col-md-6">
            <input
                type="file"
                name="attachments"
                class="form-control"
                @input="form.attachments = $event.target.files[0]"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: ["form"],
};
</script>
