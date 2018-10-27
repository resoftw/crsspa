require('./bootstrap');
import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import Vuetify from 'vuetify';
import {routes} from './routes';
import StoreData from './store';
import {initialize} from './helpers/general';

import MainApp from './components/MainApp.vue';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);

const store= new Vuex.Store(StoreData);

const router=new VueRouter({
    routes,
    mode:'history',
});


Vue.component('main-menu',require('./components/MainMenu.vue'));
Vue.component('default-layout',require('./layouts/Default.vue'));
Vue.component('blank-layout',require('./layouts/Blank.vue'));

initialize(store, router);

const app = new Vue({
    el: '#app',
    router,
    store,
    computed:{
        _layout(){
            return (this.$route.meta.layout || "default")+"-layout";
        }
    },
    created(){
        this.$store.dispatch('initMenu');

    },
    components:{
        MainApp
    }
});
