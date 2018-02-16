<template>
  <div> 
        <a v-for="prod in products" :key="prod" :prod="prod" :href="'/p/id='+ prod.id + '&name=' + prod.product_name| link">
        
            <div class="col-md-2 product-ad" data-view="" style="width:23%;">

                <div class="product-img">
                    <img :src="'storage/'+prod.product_photo">
                </div>

                <span class="sale-rotate" v-if="prod.product_sale_price !== null">SALE</span>

                <div class="product-caption">
                    <h3>{{ prod.product_name|trim }}</h3>

                    <p v-if="prod.product_sale_price !== null">PHP {{ prod.product_sale_price}}</p>

                    <p v-else-if="prod.product_sale_price === null">PHP {{ prod.product_regular_price }}</p>
                </div>
            </div>
        </a>
  </div>
</template>

<script>

export default {
    
    data() {

        return {
            products: [],
        }
    },
    created() {
        this.fetchProducts();
    },
    methods: {

        fetchProducts() {

            axios.get('/product').then(response => {

                this.products = response.data.product;
                
            });
        }

    }
}
</script>
