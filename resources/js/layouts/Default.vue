<template>
<v-app id='keep'>
    <app-drawer></app-drawer>
    <app-toolbar></app-toolbar>    
    <v-content>
        <page-header v-if="$route.meta.breadcrumb"></page-header>
        <div class='page-wrapper'>
            <slot/>
        </div>
    </v-content>
</v-app>
</template>
<style>
#keep .v-navigation-drawer__border{
     display: none;

}
.page-wrapper{
    min-height:calc(100vh - 64px - 50px - 81px );  
}
</style>

<script>
import AppDrawer from "../components/AppDrawer.vue";
import AppToolbar from "../components/AppToolbar.vue";
import PageHeader from "../components/PageHeader.vue";
    export default {
        name:'default-layout',
        components:{
            AppDrawer,
            AppToolbar,
            PageHeader,
        },
        data: () => ({
            drawer: null,
        }),
        props: {
            source: String
        },
        computed:{
            currentUser(){
                return this.$store.getters.currentUser;
            },
            darkTheme(){
                return this.$vuetify.options.extra.dark;
            },
        },
        created(){
            window.getApp=this;
        },
        methods:{
            login(){
                this.$router.push('/login');
            },
            logout(){
                this.$store.commit('logout');
                this.$router.go();
            }
        }
    }
</script>
