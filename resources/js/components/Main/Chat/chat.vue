<template>

    <ChatContent @onInput="this.$emit('onMessage', $event)" @onButton="this.$emit('sendMessage', true)" :message="message" @keyup.enter="this.$emit('sendMessage', true)" >

        <Message
            v-for="message in messages"
            :Text="message['message']"
            :Time="message['time']"
            :isYou="message['role'] == 2 ? true : false"
        />

    </ChatContent>

</template>
<script>
import ChatContent from "@/ui-components/Containers/ChatContent.vue";
import Message from "@/ui-components/Containers/Message.vue";
import {sendMessage, getMessages} from "@/Api.js";
import {Alert} from "@/Config.js";

export default {
    components:{ChatContent, Message },
    data(){return{

    }},
    props:{
        message:{
            type: String
        },
        messages:{
            type: [Array, Object],
            default: []
        }
    },
    methods:{

        async sendMessage(){
            try {
                let fakeUser = localStorage.getItem('fakeUser');
                let data = {
                    user_id: fakeUser,
                    message: this.message
                }
                const response = await sendMessage(data);
                console.log('Res:', response)
                if (response.status){
                    if (fakeUser == null){
                        localStorage.setItem('fakeUser', response.data.user_id);
                    }
                    this.message = '';
                    document.querySelector('.chat-input').value = '';
                }else{
                    Alert('error', response.data)
                }
                this.getUserMessages()
            }catch (e){
                console.log(e);
            }
        }
    },
    mounted() {
    }
}

</script>

<style scoped>

</style>
