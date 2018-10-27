<template>
<div>
    <h3>This is home!</h3>
    {{message}}
</div>
</template>
<script>
export default {
    name:'home',
    computed:{
        message(){
            return this.$store.getters.msg;
        }
    }
}
</script>

