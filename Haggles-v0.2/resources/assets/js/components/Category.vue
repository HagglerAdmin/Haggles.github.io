<template>
    <div class="section_room">

        <select @change="clickCategory" class="frm-field required" id="navigation-category" v-model="categoryList">

            <option v-for="category in categories" v-bind:key="category" :value="category.category_name"> 
                
                {{ category.category_name }}

            </option>

        </select>

    </div>
</template>

<script>
export default {

    data() {
        return {
            first: 'hahaa',
            categories: [],
            categoryList: ''
        }
    },
    methods: {

        fetchCategory() {

            axios.get('/fetch/category/name').then( response => {

                this.categories = response.data.category;
            })
        },

        clickCategory() {

            window.location.href = '/category/' + this.categoryList.toLowerCase().split(/[ ,]+/).join('-');
        }
    },
    created() {
        
        this.fetchCategory();
    },
}
</script>
