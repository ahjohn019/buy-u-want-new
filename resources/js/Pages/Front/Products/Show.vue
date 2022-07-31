<template>
    <NavBar />
    <Show :products="products" :category="productsCategory" :variants="productsVariant" />
</template>

<script>
    import NavBar from '../../../Components/Master/NavBar.vue';
    import Show from '../../../Components/Front/Products/Show.vue';

    export default{
        components:{
            NavBar,
            Show
        },
        
        props: ['products', 'productsCategory', 'productsVariant']
    }
</script>
