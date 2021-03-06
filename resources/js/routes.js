import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import QuestMain from './components/quest/Main.vue';
import QuestAdmin from './components/quest/Admin.vue';
import ArticlesAdmin from './components/articles/Admin.vue';
import QuestAdminCreate from './components/quest/AdminCreate.vue';
import UsersMain from './components/users/Main.vue';
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
        path:'/Questionnaire',
        name:'Questionnaire',
        component: QuestMain,
        meta:{
            requiresAuth:true,
            breadcrumb: false,
        }
    },
    {
        path: '/Settings/Articles',
        name:'Settings/Articles',
        component:ArticlesAdmin,
        meta: {
            requiresAuth:true,
        }
    },
    {
        path: '/Settings/Questionnaire',
        name: 'Settings/Questionnaire',
        component: QuestAdmin,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/Settings/Questionnaire/Create',
        name: 'Settings/Questionnaire/Create',
        component: QuestAdminCreate,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/Settings/Products',
        name: 'Settings/Products',
        component: QuestAdmin,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path:'/Settings/Users',
        name:'Settings/Users',
        component:UsersMain,
        meta:{
            requiresAuth:true,
        }
    }
];