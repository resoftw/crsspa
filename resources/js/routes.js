import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import QuestMain from './components/quest/Main.vue';

export const routes = [
    {
        path:'/',
        component: Home,
        name:'Home',
        meta:{
            //requiresAuth:true,
        }
    },
    {
        path:'/login',
        name:'Login',
        meta:{
            layout:'blank'
        },
        component:Login,
    },
    {
        path:'/Questioner',
        name:'Questioner',
        component: QuestMain,
        meta:{
            requiresAuth:true,
        }
    }
];