<template>
    <v-toolbar :color="toolbarColor" app dark fixed clipped-left>
    <img src="../../images/logo 64.png" height="36" alt="CRS">
    <span class="title ml-3 mr-5">C R S &nbsp;<span class="font-weight-light">PTSB</span></span>
    <v-toolbar-side-icon @click.native="handleDrawerToggle"></v-toolbar-side-icon>
    <v-text-field
        solo-inverted
        flat
        hide-details
        label="Search"
        prepend-inner-icon="search"
    ></v-text-field>
    <v-spacer></v-spacer>
    <v-btn icon @click="handleFullScreen()">
        <v-icon>fullscreen</v-icon>
    </v-btn>
    <v-menu offset-y origin="center center" class="elelvation-1" :nudge-bottom="14" transition="slide-y-transition">
        <v-btn icon flat slot="activator">
        <v-badge color="red" overlap>
        <span slot="badge">3</span>
        <v-icon medium>notifications</v-icon>
        </v-badge>
        </v-btn>
        <notification-list></notification-list>
    </v-menu>
    <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
        <v-btn icon large flat slot="activator">
        <v-avatar size="30px">
            <img src="../../images/logo 128.png" alt="User"/>
        </v-avatar>
        </v-btn>
        <v-list class="pa-0">
        <v-list-tile v-for="(item,index) in items" :to="!item.href ? { name: item.name } : null" :href="item.href" @click="item.click" ripple="ripple" :disabled="item.disabled" :target="item.target" rel="noopener" :key="index">
            <v-list-tile-action v-if="item.icon">
            <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        </v-list>
    </v-menu>

    </v-toolbar>
</template>
<script>
import NotificationList from './NotificationList';
import Util from '../helpers/utils.js';
export default {
    name:'app-toolbar',
    components:{
        NotificationList
    },
    data: () => ({
        items: [
            {
                icon: 'account_circle',
                href: '#',
                title: 'Profile',
                click: (e) => {
                console.log(e);
                }
            },
            {
                icon: 'settings',
                href: '#',
                title: 'Settings',
                click: (e) => {
                console.log(e);
                }
            },
            {
                icon: 'fullscreen_exit',
                href: '#',
                title: 'Logout',
                click: (e) => {
                    window.getApp.$store.commit('logout');
                    window.getApp.$router.push('/login');
                }
            }
        ],

    }),
    computed: {
        toolbarColor () {
        return this.$vuetify.options.extra.mainNav;
        }
    },
    methods: {
        handleDrawerToggle () {
        window.getApp.$emit('APP_DRAWER_TOGGLED');
        },
        handleFullScreen () {
        Util.toggleFullScreen();
        },
    }

}
</script>
