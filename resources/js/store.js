import { getLocalUser } from "./helpers/auth";
import { setAuthorization } from "./helpers/general";
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
                title:'Kuesioner',
                icon:'star',
                name:'Questionnaire',
            },
            {
                divider:true,
            },
            {
                title:'Settings',
                icon:'settings',
                group:'Settings',
                items:[
                    {title:'Articles',name:'Articles'},
                    {title:'Questioner',name:'Questionnaire'},
                    {title:'Products',name:'Products'},
                    {title:'Events & Promotions'},
                    {title:'Distributors'},
                    {title:'Templates'},
                    {title:'Users',name:'Users'},
                    {title:'Reports'}
                ]
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
        },
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
            setAuthorization(state.currentUser.token);
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