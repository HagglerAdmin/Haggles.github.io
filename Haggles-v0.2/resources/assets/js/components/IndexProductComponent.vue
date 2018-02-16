<template>
    <div>
        <center><div class="index-loader"></div></center>
        <div class="row" v-for="cat in categories" :key="cat">

            <div class="col-md-2 category-items" style="width:20%;margin-right:5%;height:30%;">
                <img  v-bind:src="cat.logo">
                <p>{{ cat.category_name }}</p>
                <div class="text-right" style="margin-top:5%;">
                    <a v-bind:href="/category/ + cat.category_name|link" style="color:#AB2A2F;font-size:14px;">view more</a>
                </div>
            </div>

            <product v-for="(prod, index) in products" :key="prod" :index="index" :prod="prod" v-if="prod.product_category == cat.category_name" > </product>   
        </div>     
    </div>
</template>

<script>

import Product from './Product.vue';

export default {

    data() {
        return {
            categories: [],
            products: [],
        }
    },
    components:{
         'product':Product
    },
    filters: {
        link: function (value) {
            if (!value){ return ''; } 
            value = value.toString().toLowerCase();;
            return value.split(/[ ,]+/).join('-');
        }
    },
    created() {
        this.fetchCategories();
        this.fetchProducts();
    },
    methods: {
        fetchCategories() {

            axios.get('/count-category').then(response => {

                this.categories = response.data.category;
               
            });
        },

        fetchProducts() {

            axios.get('/product').then(response => {

                this.products = response.data.product;
                
                $('.index-loader').css('display','none');
            });
        }
    }
}
</script>