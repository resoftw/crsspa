<template>

        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4 lg4>
                        <v-form @submit.prevent="login">
                    <v-card class="elevation-1 pa-3">
                    <v-card-text>
                        <div class="layout column align-center">
                        <img src="../../../images/logo 128.png" alt="Baturaja" width="128" height="128">
                        <h1 class="flex my-4 primary--text">Customer Relationship System</h1>
                        </div>                
                        <v-text-field append-icon="person" name="username" label="Login" type="text" v-model="form.username"></v-text-field>
                        <v-text-field append-icon="lock" name="password" label="Password" id="password" type="password" v-model="form.password"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type='submit' block color="primary" @click="login" :loading="loading">Login</v-btn>
                    </v-card-actions>
                    </v-card>
                        </v-form>
                </v-flex>
            </v-layout>
        </v-container> 


    
</template>
<script>
import {login} from '../../helpers/auth';
export default {
    data(){
        return {
            form:{
                username:'',
                password:'',
            },
            error:null,
        }
    },
    computed: {
        authError() {
            return this.$store.getters.authError;
        },
        loading(){
            return this.$store.getters.isLoading;
        },
    },
    methods:{
        login(){
            //console.log(this.form);
            this.authenticate();
        },
        authenticate(){
            this.$store.dispatch('login');
            login(this.$data.form)
            .then((res)=>{
                this.$store.commit('loginSuccess',res);
                this.$router.push({path:'/'});
            })
            .catch((error)=>{
                this.$store.commit('loginFailed',{error});  
            });
        }
    }
}
</script>
<style scoped>

</style>
