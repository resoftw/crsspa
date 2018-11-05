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
                    class="elevation-1"
                >
                    <template slot="items" slot-scope="props">
                    <td>{{ props.item.id }}</td>
                    <td class="text-xs-left">{{ props.item.name }}</td>
                    <td class="text-xs-left">{{ props.item.description }}</td>
                    </template>
                    <template slot="pageText" slot-scope="props">
                    Lignes {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}
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
            headers:[
                {text:'ID',align:'left',sortable:true,value:'id',width:'80px'},
                {text:'Judul',align:'left',sortable:true,value:'name'},
                {text:'Deskripsi',align:'left',sortable:true,value:'description'},
            ],
            surveys:[
                {id:1,name:'Survey 1',description:'Description 1'},
                {id:2,name:'Survey 2',description:'Description 2'},
                {id:3,name:'Survey 3',description:'Description 3'},
            ],
    }),

    watch: {
        datefrom (val) {
        this.cdatefrom = this.formatDate(val)
        },
        date (val) {
        this.cdateto = this.formatDate(val)
        },
    },

    methods:{
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
