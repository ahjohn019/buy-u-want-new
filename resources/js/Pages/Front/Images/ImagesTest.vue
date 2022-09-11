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
    
  
        <div v-for="d in data" :key="d.id">
            <div class="col-md-6">
                <img :src="'/storage/file/'+ d.name" alt="" />
            </div>
            <form :action="route('attachments.store')" method="post" enctype="multipart/form-data">
                <input type="hidden" name="update" value="update">
                <div class="col-md-6">
                    <input type="hidden" name="products" :value="d.id">
                    <input type="file" name="attachments" class="form-control">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            <button @click="deleteProducts(d.id)" class="btn btn-danger">Delete</button>
        </div>

</template>

<script>
    export default{
        props:['data'],
        methods: {
            deleteProducts(productId){
                this.$inertia.delete(route('attachments.destroy', productId));
            }
        }
    }
</script>