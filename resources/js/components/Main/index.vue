<template>

   <Chat></Chat>


</template>
<script>
import Chat from './Chat/index.vue'

export default {
    components: {Chat},
    methods:{
        darkTheme(){
            if (sessionStorage.getItem('is_visited') !=   'dark-mode-switch'){
                sessionStorage.setItem('is_visited', 'dark-mode-switch');
                location.reload();
            }
        }
    },
    mounted() {
        this.darkTheme();
    }
}
</script>
