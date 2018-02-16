
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('login-component', require('./components/LoginComponent.vue'));
Vue.component('register-component', require('./components/RegisterComponent.vue'));
Vue.component('index-products', require('./components/IndexProductComponent.vue'));
Vue.component('product', require('./components/Product.vue'));
Vue.component('search-bar', require('./components/SearchBarComponent.vue'));
Vue.component('product-view', require('./components/ProductViewComponent.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.component('modal-message', require('./components/ModalMessage.vue'));

const app = new Vue({
    el: '#app',

    // data: {
    //     messages: []
    // },
    // created() {
    //     this.fetchMessages();

    //     Echo.private('chat').listen('MessageSent', (event) => {
    //         this.messages.push({
    //             message: event.message.message,
    //             user: event.user
    //         });
    //     });
    // },
    // methods: {
    //     fetchMessages() {
    //        axios.get('/fetch-messages').then(response => {

    //             this.messages = response.data;

    //             console.log(this.messages);
    //         });
    //     },


    //     addMessage(message) {
            
    //         this.messages.push(message);

    //         axios.post('/send-messages', message).then(response => {
    //             console.log(response.data);
    //         });
    //     },

    //     composeMessage() {

            
    //     }
    // }
});