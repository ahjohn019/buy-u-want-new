<template>
    <form :action="route('attachments.store')" method="post" enctype="multipart/form-data">
        <div class="row">
            <select v-model="attachments_selected">
                <option disabled value="">Please select one</option>
                <option v-for="d in products" :key="d.id" :value="d.id">
                    {{d.sku}}
                </option>
            </select>
            <div class="col-md-6">
                <input type="hidden" name="create" value="create">
                <input type="hidden" name="product_id" :value="attachments_selected">
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
        data() {
            return {
                attachments_selected: ''
            }
        },
        props:['data','products'],
        methods: {
            deleteProducts(productId){
                this.$inertia.delete(route('attachments.destroy', productId));
            }
        }
    }
</script>