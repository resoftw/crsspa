<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex sm12>
            <h2>Kuesioner</h2>
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
                    :items="surveys"
                    :total-items="total"
                    :pagination.sync="pagination"
                    :loading="loading"
                    class="elevation-2"
                >
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.description }}</td>
                    <td class="text-xs-center">{{ props.item.start }}</td>
                    <td class="text-xs-center">{{ props.item.end }}</td>
                    </template>
                    <template slot="pageText" slot-scope="props">
                    {{ props.pageStart }} - {{ props.pageStop }} dari {{ props.itemsLength }}
                    </template>
                </v-data-table>                
            </v-card>
        </v-flex>
        <v-flex sm12>
            <v-btn color="primary" class='ml-0' to="Questionnaire/Create">Buat Kuesioner Baru</v-btn>
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
    <v-dialog v-model="dialog" width="800px">
    <v-card>
        <v-card-title
        class="grey lighten-4 py-4 title"
        >
        Buat Survey Baru
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

        <v-flex xs12 lg6>
            <v-menu
            ref="dtp1"
            :close-on-content-click="false"
            v-model="dtp1"
            :nudge-right="40"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            max-width="290px"
            min-width="290px"
            readonly
            >
            <v-text-field
                slot="activator"
                v-model="cdatefrom"
                label="Mulai"
                hint="DD-MM-YYYY"
                prepend-icon="event"
                @blur="datefrom=parseDate(cdatefrom)"
            ></v-text-field>
            <v-date-picker v-model="datefrom" no-title @input="dtp1 = false"></v-date-picker>
            </v-menu>
        </v-flex>

        <v-flex xs12 lg6>
            <v-menu
            :close-on-content-click="false"
            v-model="dtp2"
            :nudge-right="40"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            max-width="290px"
            min-width="290px"
            >
            <v-text-field
                slot="activator"
                v-model="cdateto"
                label="Sampai"
                hint="DD-MM-YYYY"
                prepend-icon="event"
                @blur="dateto=parseDate(cdateto)"
            ></v-text-field>
            <v-date-picker v-model="dateto" no-title @input="dtp2 = false"></v-date-picker>
            </v-menu>
        </v-flex>
        </v-layout>
        </v-container>
        <v-card-actions>
        <v-btn color='primary' @click="saveSurvey">Simpan dan Buat Pertanyaan</v-btn>
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
    name:'quest-admin',    
    data:vm=>({
            dialog: false,
            dtp1:false,
            dtp2:false,
            datefrom:new  Date().toISOString().substr(0, 10),
            dateto:new Date().toISOString().substr(0, 10),
            cdatefrom: vm.formatDate(new Date().toISOString().substr(0, 10)),
            cdateto: vm.formatDate(new Date().toISOString().substr(0, 10)),
            search:'',
            loading:false,
            pagination:{},
            total:0,
            _sto:null,
            headers:[
                {text:'ID',align:'left',sortable:true,value:'id',width:'80px'},
                {text:'Judul',align:'left',sortable:true,value:'name',width:'300px'},
                {text:'Deskripsi',align:'left',sortable:true,value:'description',width:'400px'},
                {text:'Mulai',align:'center',sortable:true,value:'start',width:'220px'},
                {text:'Akhir',align:'center',sortable:true,value:'end',width:'220px'},
            ],
            surveys:[
            ],
    }),
    mounted(){
        //this.loadData();
    },
    watch: {
        pagination(){
            this.loadData();
        },
        search(){
            var vm=this;
            if (vm._sto)clearTimeout(vm._sto);
            vm._sto=setTimeout(function(){
                vm.loadData();
            },400);
        },
        datefrom (val) {
        this.cdatefrom = this.formatDate(val)
        },
        date (val) {
        this.cdateto = this.formatDate(val)
        },
    },
//array ([descending] => false 
//  [page] => 1
    //     [rowsPerPage] => 5
    //     [sortBy] => id
    //     [totalItems] => 0)
    methods:{
        loadData()
        {
            var vm=this;
            var prm={
                page:vm.pagination.page,
                per_page:vm.pagination.rowsPerPage,
                sort:vm.pagination.sortBy,
                desc:vm.pagination.descending,
                q:vm.search,
            }
            vm.loading=true;
            axios.get('/api/quest',{params:prm})
            .then(r=>{
                //console.log(r.data);
                vm.pagination.page=r.data.current_page;
                vm.total=r.data.total;
                //vm.pagination.rowsPerPage=r.data.per_page;
                vm.surveys=r.data.data;
                vm.loading=false;
            })
            .catch(r=>{
                console.error(r);
                vm.loading=false;
            });
        },
        formatDate (date) {
            if (!date) return null

            const [year, month, day] = date.split('-')
            return `${day}-${month}-${year}`
        },
        parseDate (date) {
            if (!date) return null

            const [day, month, year] = date.split('-')
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
        },
        showdialog()
        {
            this.datefrom=new  Date().toISOString().substr(0, 10);
            this.dateto=new Date().toISOString().substr(0, 10);
            this.dialog = !this.dialog;
        },
        saveSurvey()
        {
            this.dialog=false;
        }
    }
}
</script>
