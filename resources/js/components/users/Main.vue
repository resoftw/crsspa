<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex sm12>
            <h2>Users</h2>
        </v-flex>
        <v-flex lg12>
            <v-card>
                <v-toolbar card color='white'>
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
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.email }}</td>
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

    <v-dialog v-model="dialog" width="800px">
    <v-card>
        <v-card-title
        class="grey lighten-4 py-4 title"
        >
        {{dialogTitle}}
        </v-card-title>
        <v-container grid-list-sm class="pa-4">
        <v-layout row wrap>
            <v-flex xs12>
                <v-text-field 
                    label="Judul"
                    hint="Judul Kuesioner"
                ></v-text-field>
            </v-flex>
            <v-flex xs12>
            <v-textarea
                name="input-7-1"
                label="Deskripsi"
                hint="Deskripsi dari Kuesioner"
            ></v-textarea>
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
<script>
export default {
    data(){
        return {
            headers:[
                {text:'ID',value:'id'},
                {text:'Nama',value:'name'},
                {text:'Email',value:'email'}
            ],
            users:[],
            total:0,
            search:'',
            pagination:{},
            loading:false,
            dialog:false,
            dialogTitle:'Tambah User',
        }
    },
    mounted(){
        this.loadData();
    },
    methods:{
        loadData(){
            var vm=this;
            axios.get('/api/users')
            .then(r=>{
                vm.users=r.data.data;
                console.log(vm.users);
            })
            .catch(r=>{
                console.error(r);
            })
        },
        showdialog()
        {
            this.dialog = true;
        },
        saveUser()
        {
            this.dialog=false;
        }
    },
}
</script>

