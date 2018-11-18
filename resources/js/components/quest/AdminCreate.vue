<template>
<v-container grid-list-xl fluid>
    <v-layout row wrap>
        <v-flex lg12>
            <v-card>
                <v-card-title class='py-4 title'>Kuesioner Baru</v-card-title>
                <v-container grid-list-sm>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-text-field label="Judul" hint="Judul Kuesioner" v-model="judul"></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                        <v-textarea
                            name="input-7-1"
                            label="Deskripsi"
                            hint="Deskripsi dari Kuesioner"
                            v-model="deskripsi"
                        ></v-textarea>
                        </v-flex>

                        <v-flex xs12 sm6>
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

                        <v-flex xs12 sm6>
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
            </v-card>
            <v-card class='mt-2' v-for="(g,i) in groups" :key="i" color="#f0f0f0">
                <v-card-title class='py-1 title'>
                    Group {{i+1}}<v-spacer></v-spacer>
                    <v-btn fab small @click="addgroup"><v-icon>add</v-icon></v-btn>
                    <v-btn fab small @click="movegroupup(i)" :disabled="i<=0"><v-icon>expand_less</v-icon></v-btn>
                    <v-btn fab small @click="movegroupdn(i)" :disabled="i>=groups.length-1"><v-icon>expand_more</v-icon></v-btn>
                </v-card-title>
                <v-container grid-list-sm>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-text-field
                                label="Judul"
                                v-model="g.t"
                            ></v-text-field>
                            <v-textarea
                                label="Deskripsi"
                                v-model="g.d"
                            ></v-textarea>
                        </v-flex>
                        <v-divider></v-divider>
                        <v-flex xs12>
                            <v-card raised color="#fff">
                                <v-card-title class='py-2 title'>
                                    Pertanyaan
                                    <v-spacer></v-spacer>
                                    <v-btn fab small @click="addq(i)"><v-icon>add</v-icon></v-btn>

                                </v-card-title>
                                <v-container grid-list-sm>
                                    <v-layout row wrap v-for="(item,j) in g.q" :key="j">
                                        <v-flex xs9>
                                        <v-text-field
                                            :label="'Pertanyaan '+(j+1)"
                                            v-model=item.t
                                            append-icon="close"
                                            @click:append="delq(j)"
                                        ></v-text-field>
                                        </v-flex>
                                        <v-flex xs3>
                                            <v-btn fab small><v-icon>expand_less</v-icon></v-btn>
                                            <v-btn fab small><v-icon>expand_more</v-icon></v-btn>
                                        </v-flex>
                                    </v-layout>
                                
                                </v-container>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-card class='mt-2'>
                <v-card-text>
                    <v-btn color="primary" @click="save">Save</v-btn>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>   
</template>
<script>
export default {
    data:vm=>({
            dtp1:false,
            dtp2:false,
            datefrom:new  Date().toISOString().substr(0, 10),
            dateto:new Date().toISOString().substr(0, 10),
            cdatefrom: vm.formatDate(new Date().toISOString().substr(0, 10)),
            cdateto: vm.formatDate(new Date().toISOString().substr(0, 10)),
            judul:'',
            deskripsi:'',
            groups:[
                {
                    t:'',
                    d:'',
                    q:[
                        {
                            t:'',
                            a:true,
                        }
                    ]
                }
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
        save(){
            var vm=this;
            var dat={
                j:vm.judul,
                d:vm.deskripsi,
                f:vm.datefrom,
                t:vm.dateto,
                g:vm.groups
            }
            axios.post('/api/quest/add',dat)
            .then(r=>{
                console.log(r);
            })
        },
        delq (v) {
            console.log("delq:",v);
        },
        addq(n){
            this.groups[n].q.push({
                t:'',
                a:true,
            });
        },
        addgroup(){
            this.groups.push({
                t:'',
                q:[
                    {t:'',a:true}
                ]
            });
        },
        movegroupup(n)
        {
            if (n>0)
            this.groups.move(n,n-1)
        },
        movegroupdn(n)
        {
            if (m<this.groups.length-1)
            this.groups.move(n,n+1)
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
    }

}
</script>

