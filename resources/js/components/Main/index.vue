<template>

   <Chat></Chat>


</template>
<script>
import Chat from './Chat/index.vue'

export default {
    components: {Chat},
    methods:{
        darkTheme(){
            let mode = sessionStorage.setItem('is_visited', 'dark-mode-switch');
        }
    },
    mounted() {
        this.darkTheme();
    }
}
</script>
