<template>
    <NavBar />
    <div
        v-if="$page.props.flash.message"
        class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert"
    >
        <span class="font-medium">
            {{ $page.props.flash.message }}
        </span>
    </div>
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
