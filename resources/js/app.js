require('./bootstrap');
import swal from 'sweetalert';
import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";
import Vuetify from 'vuetify';
import {routes} from './routes';
import StoreData from './store';
//import colors from 'vuetify/es5/util/colors';
import {initialize} from './helpers/general';

import MainApp from './components/MainApp.vue';

function swalplugin(Vue) {
    Vue.prototype.$swal = Vue.$swal = swal
}


Vue.use(swalplugin);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify, {
    // theme: {
    //   primary: colors.indigo.base, // #E53935
    //   secondary: colors.indigo.lighten4, // #FFCDD2
    //   accent: colors.indigo.base // #3F51B5
    // },
    dark:true,
    options: {
        themeVariations: ['primary', 'secondary', 'accent'],
        extra: {
            mainToolbar: {
                color: 'primary',
            },
            sideToolbar: {},
            sideNav: 'primary',
//            mainNav: 'primary lighten-1',
            mainNav: 'blue darken-4',
            bodyBg: '',
            dark:true,
        }
    }
});
const store= new Vuex.Store(StoreData);

const router=new VueRouter({
    routes,
    mode:'hash',
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
