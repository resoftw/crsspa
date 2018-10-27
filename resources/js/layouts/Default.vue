<template>
<v-app id='keep'>
    <v-navigation-drawer
    :clipped="$vuetify.breakpoint.lgAndUp"
    v-model="drawer"
    :dark="$vuetify.dark"
    width="260"
    fixed
    app
    >
    <main-menu></main-menu>
    </v-navigation-drawer>
    <v-toolbar
    clipped-left
    color="red darken-4"
    absolute
    app
    dark
    >
        <v-toolbar-side-icon @click.native="drawer = !drawer" class='ml-0'></v-toolbar-side-icon>
        <span class="title ml-3 mr-5">C<span class="font-weight-light">ustomer</span>&nbsp;R<span class="font-weight-light">elationship</span>&nbsp;S<span class="font-weight-light">ystem</span></span>

    <v-text-field
        flat
        solo-inverted
        hide-details
        prepend-inner-icon="search"
        label="Search"
        class="hidden-sm-and-down"
    ></v-text-field>
    <v-spacer></v-spacer>
    <v-btn icon v-if="currentUser">
        <v-icon>apps</v-icon>
    </v-btn>
    <v-btn icon v-if="currentUser">
        <v-icon>notifications</v-icon>
    </v-btn>
    <span class='title font-weight-light'>Login</span>

    <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
    <v-btn icon large flat slot="activator">
        <v-avatar size="32px" tile>
        <img
            src="../../images/logo 32.png"
            alt="Vuetify"
        >
        </v-avatar>
    </v-btn>
    <v-list class="pa-0">
        <v-list-tile v-if="currentUser" href="#" ripple="ripple" rel='noopener'>
            <v-list-tile-action>
                <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Profile</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile v-if="currentUser" href="#" @click="logout" ripple="ripple" rel='noopener'>
            <v-list-tile-action>
                <v-icon>fullscreen_exit</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile v-else href="#" @click="login" ripple="ripple" rel='noopener'>
            <v-list-tile-content>
                <v-list-tile-title>Login</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>
    </v-menu>

    </v-toolbar>
    <v-content>
    <v-container fluid fill-height>
        <v-layout align-top>
            <slot/>
        </v-layout>
    </v-container>
    </v-content>
    <v-btn
    fab
    bottom
    right
    color="pink"
    dark
    fixed
    @click="dialog = !dialog"
    >
    <v-icon>add</v-icon>
    </v-btn>
    <v-dialog v-model="dialog" width="800px">
    <v-card>
        <v-card-title
        class="grey lighten-4 py-4 title"
        >
        Create contact
        </v-card-title>
        <v-container grid-list-sm class="pa-4">
        <v-layout row wrap>
            <v-flex xs12 align-center justify-space-between>
            <v-layout align-center>
                <v-avatar size="40px" class="mr-3">
                <img
                    src="//ssl.gstatic.com/s2/oz/images/sge/grey_silhouette.png"
                    alt=""
                >
                </v-avatar>
                <v-text-field
                placeholder="Name"
                ></v-text-field>
            </v-layout>
            </v-flex>
            <v-flex xs6>
            <v-text-field
                prepend-icon="business"
                placeholder="Company"
            ></v-text-field>
            </v-flex>
            <v-flex xs6>
            <v-text-field
                placeholder="Job title"
            ></v-text-field>
            </v-flex>
            <v-flex xs12>
            <v-text-field
                prepend-icon="mail"
                placeholder="Email"
            ></v-text-field>
            </v-flex>
            <v-flex xs12>
            <v-text-field
                type="tel"
                prepend-icon="phone"
                placeholder="(000) 000 - 0000"
                mask="phone"
            ></v-text-field>
            </v-flex>
            <v-flex xs12>
            <v-text-field
                prepend-icon="notes"
                placeholder="Notes"
            ></v-text-field>
            </v-flex>
        </v-layout>
        </v-container>
        <v-card-actions>
        <v-btn flat color="primary">More</v-btn>
        <v-spacer></v-spacer>
        <v-btn flat color="primary" @click="dialog = false">Cancel</v-btn>
        <v-btn flat @click="dialog = false">Save</v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>
</v-app>
</template>
<style>
#keep .v-navigation-drawer__border{
     display: none;

}
</style>

<script>
    export default {
        name:'default-layout',
        data: () => ({
            dialog: false,
            drawer: null,
        }),
        props: {
            source: String
        },
        computed:{
            currentUser(){
                return this.$store.getters.currentUser;
            }
        },
        created(){
            window.getApp=this;
        },
        methods:{
            login(){
                this.$router.push('/login');
            },
            logout(){
                this.$store.commit('logout');
                this.$router.go();
            }
        }
    }
</script>
