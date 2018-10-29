<template>
    <v-toolbar :color="toolbarColor" app dark absolute clipped-left>
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
    </v-toolbar>
</template>
<script>
export default {
    name:'app-toolbar',
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
        }
    }

}
</script>
