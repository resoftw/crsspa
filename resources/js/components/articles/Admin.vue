<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex sm12>
            <h2>Articles</h2>
            <hr/>
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
                    :items="articles"
                    :total-items="total"
                    :pagination.sync="pagination"
                    :loading="loading"
                    class="elevation-2"
                >
                    <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.title }}</td>
                    <td class="text-xs-left">{{ props.item.subtitle }}</td>
                    <td class="text-xs-left">{{ props.item.author_name }}</td>
                    <td class='text-xs-left'>{{ props.item.tags.map(a=>a.name).join(',')}}</td>
                    <td class="text-xs-center">
                        <v-btn small flat icon color='blue' @click="editperm(props.item)"><v-icon>speaker_notes</v-icon></v-btn>
                        <v-btn small flat icon color='green' @click="edit(props.item)"><v-icon>edit</v-icon></v-btn>
                        <v-btn small flat icon color='red' @click="del(props.item.id)"><v-icon>delete</v-icon></v-btn>
                    </td>
                    </template>
                    <template slot="pageText" slot-scope="props">
                    {{ props.pageStart }} - {{ props.pageStop }} dari {{ props.itemsLength }}
                    </template>
                </v-data-table>                
            </v-card>

        </v-flex>
    </v-layout>  
</v-container>  
</template>
<script>
export default {
    data(){
        return {
            search:'',
            headers:[
                {text:'ID',value:'id'},
                {text:'Judul',value:'title'},
                {text:'Sub Judul',value:'subtitle'},
                {text:'Author',value:'author_name'},
                {text:'Tags',value:'tags'},
                {text:'Action',value:null}

            ],
            articles:[],
            pagination:{},
            total:0,
            loading:false,
        }
    },
    mounted(){
        this.loadData();
    },
    methods:{
        loadData(){
            var vm=this;
            axios.get('/api/articles')
            .then(r=>{
                //console.log(r.data.data);
                vm.articles=r.data.data;
            })
            .catch(r=>{
                console.error(r);
            })
        },

    }
}
</script>

