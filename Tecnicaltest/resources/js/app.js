require('./libraries/bootstrap');

import Vue from 'vue'
import router from './routes'
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

window.toastr = require('toastr')
Vue.use(VueToastr2)
Vue.component('App', require('./components/AppComponent.vue').default)
Vue.component('products', require('./components/ProductsComponent.vue').default)
/* Vue.component('catogories', require('./components/CategoriesComponent.vue').default) */


const app = new Vue({
    el: '#app',
    router
});