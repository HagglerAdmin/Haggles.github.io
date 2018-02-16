<template>
    <form v-on:submit.prevent="searches" method="post">

        <div class="search">
            <input type="search" placeholder="Search product here" v-model="search">
        </div>

        <category></category>
    
        <div class="sear-sub">
            <input type="submit" value=" ">
        </div>

        <div class="clearfix"></div>
    </form>
</template>

<script>

import Category from './Category.vue';

export default {
    data() {
        return {

        search: '',
        }
    },
    components:{
        'category':Category
    },
    methods: {
        searches() {

            window.location.href = "/product/search/"+ this.search;
        }
    },
}
</script>
