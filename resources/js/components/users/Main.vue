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
        <v-flex sm12>
            <v-btn color="primary" class='ml-0' to="Questionnaire/Create">Daftarkan User</v-btn>
        </v-flex>
    <v-btn
    fab
    bottom
    right
    color="pink"
    dark
    fixed
    disabled
    @click="showdialog"
    >
    <v-icon>add</v-icon>
    </v-btn>
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
            showdialog:false,
            pagination:{},
            loading:false,
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
        }
    },
}
</script>

