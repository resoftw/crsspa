import { getLocalUser } from "./helpers/auth";

const user=getLocalUser();

export default {
    state: {
        currentUser:user,
        isLoggedIn: !!user,
        loading:false,
        auth_error:null,
        mainmenu:[
            {
                text:'Home',
                icon:'home',
                url:'/',
            },
            {
                text:'Dashboard',
                icon:'dashboard',
                url:'/dashboard',
            },
            {
                text:'Information',
                icon:'live_help',
                'icon-alt':'keyboard_arrow_down',
                model:'true',
                children:[
                    {text:'Cara Pengaduan',url:'/help/cara'},
                    {text:'Event Promotion',url:'/event'},
                    {text:'Products & Packages',url:'#'},
                    {text:'List Distrubution',url:'#',icon:'report'},
                ],
            },
        ],
        mainmenux: [{
                icon: 'contacts',
                text: 'Contacts'
            },
            {
                icon: 'history',
                text: 'Frequently contacted'
            },
            {
                icon: 'content_copy',
                text: 'Duplicates'
            },
            {
                icon: 'keyboard_arrow_up',
                'icon-alt': 'keyboard_arrow_down',
                text: 'Labels',
                model: true,
                children: [{
                    icon: 'add',
                    text: 'Create label'
                }]
            },
            {
                icon: 'keyboard_arrow_up',
                'icon-alt': 'keyboard_arrow_down',
                text: 'More',
                model: false,
                children: [{
                        text: 'Import'
                    },
                    {
                        text: 'Export'
                    },
                    {
                        text: 'Print'
                    },
                    {
                        text: 'Undo changes'
                    },
                    {
                        text: 'Other contacts'
                    }
                ]
            },
            {
                icon: 'settings',
                text: 'Settings'
            },
            {
                icon: 'chat_bubble',
                text: 'Send feedback'
            },
            {
                icon: 'help',
                text: 'Help'
            },
            {
                icon: 'phonelink',
                text: 'App downloads'
            },
            {
                icon: 'keyboard',
                text: 'Go to the old version'
            }
        ],


    },
    getters: {
        isLoading(state){
            return state.loading;
        },
        isLoggedIn(state){
            return state.isLoggedIn;
        },
        currentUser(state){
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        mainMenu(state){
            return state.mainmenu;
        }
    },
    mutations: {
        login(state){
            state.loading=true;
            state.auth_error=null;
        },
        loginSuccess(state,payload){
            state.auth_error=null;
            state.isLoggedIn=true;
            state.loading=false;
            state.currentUser=Object.assign({},payload.user,{token:payload.access_token});
            localStorage.setItem('user',JSON.stringify(state.currentUser));
        },
        loginFailed(state,payload){
            state.loading=false;
            state.auth_error=payload.error;
        },
        logout(state){
            localStorage.removeItem("user");
            state.isLoggedIn=false;
            state.currentUser=null;
        },
        updateMenu(state,m){
            state.mainmenu=m;
        }
    },
    actions: {
        login(context){
            context.commit("login");
            context.dispatch('initMenu');
        },
        initMenu(context){
            //context.commit('updateMenu', context.state.mainmenu);
            //return;
            axios.get('/api/mainmenu')
            .then (r=>{
                context.commit('updateMenu',r.data.menu);
            });
        },
    },
}