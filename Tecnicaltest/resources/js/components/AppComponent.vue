<template>
    <div class="d-flex bg-white">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading pb-3">
                <img src="img/logo.png" alt="">
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link to="/home">Dashboard</router-link> 
                </div>
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link to="/products">Productos</router-link> 
                </div>
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link to="/categories">Categorias</router-link> 
                </div>
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link to="/users">Usuarios</router-link> 
                </div>
            </div>
        </div>

        <div class="p-0">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>