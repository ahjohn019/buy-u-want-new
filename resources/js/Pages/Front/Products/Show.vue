<template>
    <NavBar />
    <Show :products="products" :category="productsCategory" :variants="productsVariant" />
    <br>
    <br>
    <Footer />
</template>

<script>
    import NavBar from '../../../Components/Master/NavBar.vue';
    import Show from '../../../Components/Front/Products/Show.vue';
    import Footer from '../../../Components/Master/Footer.vue';

    export default{
        components:{
            NavBar,
            Show,
            Footer
        },
        
        props: ['products', 'productsCategory', 'productsVariant']
    }
</script>
