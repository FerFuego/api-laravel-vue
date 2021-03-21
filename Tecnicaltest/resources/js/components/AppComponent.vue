<template>
    <div class="d-flex bg-white">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading pb-3">
                <img src="img/logo.png" alt="">
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link :to="{name:'home'}">Dashboard</router-link> 
                </div>
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link :to="{name:'products'}">Productos</router-link> 
                </div>
                <div class="list-group-item list-group-item-action bg-light">
                    <router-link :to="{name:'categories'}">Categorias</router-link> 
                </div>
            </div>
        </div>

        <div class="p-0">
            
            <products></products>

            <!-- <transition name="slide-fade" mode="out-in"> -->
                <!-- <router-view></router-view> -->
            <!-- </transition> -->
        
        </div>
    </div>
</template>