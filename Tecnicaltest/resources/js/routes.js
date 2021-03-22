import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home.vue'
import Products from './views/Products.vue'
import Categories from './views/Categories.vue'
import Users from './views/Users.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/home',
            component: Home
        },
        {
            path: '/products',
            component: Products
        },
        {
            path: '/categories',
            component: Categories
        },
        {
            path: '/users',
            component: Users
        }
    ],
    mode: 'history'
})