<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex sm12>
            <h2>Users</h2>
        </v-flex>
        <v-flex lg12>
            <v-card>
                <v-toolbar card color='grey lighten-1'>
                    <v-text-field
                        flat solo
                        prepend-icon="search"
                        placeholder="Type something"
                        v-model="search"
                        hide-details
                        class="hidden-sm-and-down"></v-text-field>
                </v-toolbar>
                <v-divider></v-divider>
                <v-data-table
                    :headers="headers"
                    :items="users"
                    :total-items="total"
                    :pagination.sync="pagination"
                    :loading="loading"
                    class="elevation-2"
                >
                    <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.username }}</td>
                    <td class="text-xs-left">{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.email }}</td>
                    <td class='text-xs-left'>{{ props.item.roles.map(a=>a.name).join(',')}}</td>
                    <td class="text-xs-center">
                        <v-btn small flat icon color='green' @click="edit(props.item)"><v-icon>edit</v-icon></v-btn>
                        <v-btn small flat icon color='red'><v-icon>delete</v-icon></v-btn>
                    </td>
                    </template>
                    <template slot="pageText" slot-scope="props">
                    {{ props.pageStart }} - {{ props.pageStop }} dari {{ props.itemsLength }}
                    </template>
                </v-data-table>                
            </v-card>
        </v-flex>
        <!-- <v-flex sm12>
            <v-btn color="primary" class='ml-0' to="Users/Create">Daftarkan User</v-btn>
        </v-flex> -->
    <v-btn
    fab
    bottom
    right
    color="pink"
    dark
    fixed
    @click="showdialog"
    >
    <v-icon>add</v-icon>
    </v-btn>

    <v-dialog v-model="dialog" width="800">
    <v-card>
        <v-card-title
        class="grey lighten-4 py-4 title nowrap"
        primary-title
        >
        {{dialogTitle}}
        </v-card-title>
        <v-container grid-list-xl class="xpa-4">
        <v-layout row wrap>
            <v-flex xs6>
                <v-text-field 
                    label="Username"
                    hint="Username untuk login"
                    :rules="[rules.required]"
                    v-model="frm.username"
                ></v-text-field>
            </v-flex>
            <v-flex xs6>
                <v-text-field 
                    label="Full Name"
                    hint="Full Name"
                    :rules="[rules.required]"
                    v-model="frm.name"
                ></v-text-field>
            </v-flex>
            <v-flex xs12>
                <v-text-field 
                    label="Email"
                    hint="Email address"
                    :rules="[rules.email]"
                    v-model="frm.email"
                ></v-text-field>
            </v-flex>
            <v-flex xs12>
                <v-text-field 
                    :append-icon="show1 ? 'visibility_off' : 'visibility'"
                    :rules="[rules.pwd]"
                    :type="show1 ? 'text' : 'password'"
                    name="input-10-1"
                    label="Password"
                    hint="At least 8 characters"
                    v-model="frm.password"
                    counter
                    @click:append="show1 = !show1"
                ></v-text-field>
            </v-flex>
            <v-flex xs12 v-if="!show1">
                <v-text-field 
                    :rules="[rules.pwd]"
                    :type="'password'"
                    name="input-10-1"
                    label="Confirm Password"
                    hint="At least 8 characters"
                    counter
                ></v-text-field>
            </v-flex>
            <v-flex xs12>
                <v-select
                  :items="uroles"
                  :menu-props="{ maxHeight: '400' }"
                  label="Roles"
                  item-text="name"
                  item-value="id"
                  v-model="frm.roles"
                  multiple
                  hint="User Roles"
                  persistent-hint
                ></v-select>
            </v-flex>

        </v-layout>
        </v-container>
        <v-card-actions>
        <v-btn color='primary' @click="saveUser">Simpan</v-btn>
        <v-spacer></v-spacer>
        <v-btn flat @click="dialog = false">Cancel</v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>


    </v-layout>
</v-container>
    
</template>
<style scoped>
.nowrap {
    white-space: nowrap;
}
</style>
<script>
export default {
    data(){
        return {
            headers:[
                {text:'ID',value:'id'},
                {text:'Username',value:'name'},
                {text:'Nama',value:'name'},
                {text:'Email',value:'email'},
                {text:'Roles',value:'roles'},
                {text:'Action',value:null}
            ],
            users:[],
            total:0,
            search:'',
            pagination:{},
            loading:false,
            dialog:false,
            show1:false,
            uroles:null,
            frm:{

            },
            rols:[],
            dialogTitle:'Tambah User',
            rules: {
                required: value => !!value || 'Required.',
                pwd: v => {
                    if (v){
                        if (v.length<8)return "Min 8 characters";
                    }
                },
                min: v => (v && v.length >= 8) || 'Min 8 characters',
                email: value => {
                    if(value && value.length > 0) {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        return pattern.test(value) || 'Invalid e-mail.';
                    }
                    return 'Invalid e-mail.';
                },              
                emailMatch: () => ('The email and password you entered don\'t match')
            }            
        }
    },
    created()
    {
        this.loadRoles();
    },
    mounted(){
        this.loadData();
    },
    methods:{
        loadRoles(){
            var vm=this;
            axios.get('/api/roles')
            .then(r=>{
                vm.uroles=r.data;
                //console.log('here',r.data);
            })
            .catch(r=>{
                console.error(r);
            })
        },
        loadData(){
            var vm=this;
            axios.get('/api/users')
            .then(r=>{
                vm.users=r.data.data;
                //console.log(vm.users);
            })
            .catch(r=>{
                console.error(r);
            })
        },
        showdialog()
        {
            this.frm={};
            this.dialog = true;
        },
        edit(it)
        {
            this.frm=it;
            this.dialog=true;

        },
        saveUser()
        {
            this.dialog=false;
        }
    },
}
</script>

