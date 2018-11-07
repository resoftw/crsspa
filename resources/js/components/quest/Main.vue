<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex sm12>
        <h2>Kuestioner Untuk Anda</h2>
        </v-flex>
        <v-flex lg12>
            <v-card>
                <v-toolbar card color="white">
                <v-text-field
                flat
                solo
                prepend-icon="search"
                placeholder="Type something"
                v-model="search"
                hide-details
                class="hidden-sm-and-down"
                ></v-text-field>     
                <v-btn icon>
                    <v-icon>filter_list</v-icon>
                </v-btn>         
                </v-toolbar>
                <v-divider></v-divider>
                <v-data-table
                    :headers="headers"
                    :items="surveys"
                    class="elevation-1"
                >
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.description }}</td>
                    <td class="text-xs-left">{{ props.item.start }}</td>
                    <td class="text-xs-left">{{ props.item.end }}</td>
                    <td class="text-xs-left">{{ props.item.status }}</td>
                    </template>
                </v-data-table>                
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
</template>
<script>
export default {
    name:'quest-main',
    data(){
        return {
            search:'',

            headers: [
                {
                    text: 'Judul',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                { text: 'Keterangan', value: 'description' },
                { text: 'Mulai', value: 'start' },
                { text: 'Akhir', value: 'end' },
                { text: 'Status', value: 'status' },
                ],
            surveys: [],

        }
    },
    computed:{
        currentUser(){
            return this.$store.getters.currentUser;
        }
    },
    mounted(){
        this.loadData();
    },
    methods:{
        loadData(){
            var vm=this;
            axios.get('/api/quest')
            .then(r=>{
                vm.surveys=r.data.data;
            })
            .catch(r=>{
                console.log(r.response);
            })
        }
    }
}
</script>
