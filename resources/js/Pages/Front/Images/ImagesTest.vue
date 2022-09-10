<template>
    <form :action="route('attachments.store')" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="product_id" value="1">
                <input type="file" name="attachments" class="form-control">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </form>
</template>