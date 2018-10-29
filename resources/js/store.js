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
                header:'Home',
            },
            {
                title:'Dashboard',
                group:'apps',
                icon:'dashboard',
                name:'Home',
            },
            {
                title:'Information',
                icon:'live_help',
                group:'information',
                'icon-alt':'keyboard_arrow_down',
                model:'true',
                items:[
                    {title:'Cara Pengaduan',name:'CaraPengaduan'},
                    {title:'Event Promotion',name:'EventPromotion'},
                    {title:'Products & Packages',name:'ProductsPackages'},
                    {title:'List Distrubution',name:'ListDistributor'},
                ],
            },
            {
                title:'Issues',
                icon:'report',
                group:'issues',
                items:[
                    {title:'Progress',name:'Progress'},
                    {title:'Kritik dan Saran',name:'KritikSaran'},
                    {title:'Reporting',name:'Reporting'},
                ],
            },
            {
                header:'E-Ticketing'
            },
            {
                title:'Nomor Tiket',
                icon:'style',
                name:'NomorTicket',
            },
            {
                divider:'true',
            },
            {
                title:'Questioner',
                icon:'star',
                name:'Questioner',
            },
            {
                divider:true,
            },
            {
                title:'Settings',
                icon:'settings',
                items:[
                    {title:'Products'},
                    {title:'Events & Promotions'},
                    {title:'Distributors'},
                    {title:'Templates'},
                    {title:'Users',},
                    {title:'Reports'}
                ]
            }
        ],
        mainmenux: [{
                icon: 'contacts',
                title: 'Contacts'
            },
            {
                icon: 'history',
                title: 'Frequently contacted'
            },
            {
                icon: 'content_copy',
                title: 'Duplicates'
            },
            {
                icon: 'keyboard_arrow_up',
                'icon-alt': 'keyboard_arrow_down',
                title: 'Labels',
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
            //context.dispatch('initMenu');
        },
        initMenu(context){
            //context.commit('updateMenu', context.state.mainmenu);
            //return;
            //axios.get('/api/mainmenu')
            //.then (r=>{
                //context.commit('updateMenu',r.data.menu);
            //});
        },
    },
}