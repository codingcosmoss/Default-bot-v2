
<template>
    <div class="chat_container">
        <Microfon/>
        <Chat></Chat>
    </div>
</template>

<script>
import Chat from "./chat.vue";
import Microfon from "./microfon.vue";
    export default {
        components:{Microfon, Chat}
    }
</script>

<style>
    .chat_container{
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
    }

    @media (max-width: 754px) {
        .chat_container{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .container-fluid{
            width: 100% !important ;
            height: 10px !important;
        }
    }
</style>
