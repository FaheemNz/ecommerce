require('./bootstrap');


Vue.component('add-to-cart', require('./components/AddToCart.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('product-form', require('./components/ProductForm.vue').default);
Vue.component('user-profile', require('./components/UserProfile.vue').default);

const app = new Vue({
    el: '#app'
});