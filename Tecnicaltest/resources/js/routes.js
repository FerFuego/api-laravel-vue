import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./views/Home.vue')
        },
        {
            path: '/products',
            name: 'products',
            component: require('./views/Products')
        },
        {
            path: '/categories',
            name: 'categories',
            component: require('./views/Categories')
        },
        {
            path: '*',
            component: require('./views/404')
        }
    ],
    mode: 'history' // evita # en url
})