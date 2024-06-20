
<template>
    <div class="chat_container">
        <Microfon  @onMessage="message = $event" />
        <Chat @onMessage="message = $event" @sendMessage="sendMessage()" :message="message" :messages="messages" />
    </div>
</template>

<script>
import {sendMessage, getMessages} from "@/Api.js";
import Chat from "./chat.vue";
import {Alert} from "@/Config.js";
import Microfon from "./microfon.vue";
    export default {
        components:{Microfon, Chat},
        data(){return{
            socketData: [],
            message: '',
            messages: [],
        }},
        methods: {
            connectWebSocket() {
                let fakeUser = localStorage.getItem('fakeUser');
                if (fakeUser == null){
                    fakeUser = 0;
                }
                console.log(fakeUser)
                this.ws = new WebSocket('ws://127.0.0.1:8081?id=' + fakeUser);

                this.ws.onopen = () => {
                    console.log('Ulandi...');
                    Alert('success',null, 'WebSocket connected !')
                };

                this.ws.onmessage = (event) => {
                    this.socketData = JSON.parse(event.data);
                    if (this.socketData.data.status != true ) {
                        Alert('error',null, this.socketData.message)
                    }else if (this.socketData.type == 'connect') {

                        localStorage.setItem('fakeUser', this.socketData.data.fakeUser.id)
                        localStorage.setItem('resource_id', this.socketData.data.fakeUser.socket_id)
                        console.log('Connect:', this.socketData.data)
                    }else if (this.socketData.type == 'message') {
                        this.pushMessage(this.socketData.data)
                    }
                    console.log('Xabar keldi:', this.socketData);
                };

                this.ws.onclose = () => {
                    Alert('error', null,'Disconnected from WebSocket server')
                    this.reconnect();
                };

                this.ws.onerror = (error) => {
                    Alert('error',null, 'WebSocket error')
                    console.log('WebSocket error:', error);
                };
            },
            sendMessage() {
                let fakeUser = localStorage.getItem('fakeUser');
                let data = {
                    role: 2,
                    time: this.getTime(),
                    user_id: fakeUser,
                    message: this.message.replace(/\s+/g, " ").trim()
                }
                this.pushMessage(data);
                console.log(this.message)
                if (this.ws && this.ws.readyState === WebSocket.OPEN) {
                    this.ws.send(JSON.stringify(data));
                    this.message = '';
                    document.querySelector('.chat-input').value = '';
                } else {
                    Alert('error',null, 'WebSocket is not connected')
                    console.log('WebSocket is not connected');
                }
            },
            closeConnection() {
                if (this.ws) {
                    this.ws.close();
                }
            },
            reconnect() {
                console.log('Reconnecting...')
                setTimeout(() => {
                    this.connectWebSocket()
                }, 2000);
            },
            async getUserMessages() {
                try {
                    let fakeUser = localStorage.getItem('fakeUser');
                    const response = await getMessages(fakeUser);
                    if (response.status) {
                        this.messages = response.data.slice().reverse();
                        this.$nextTick(() => {
                            const element = document.querySelector('.simplebar-content-wrapper');
                            element.scrollTo({top: element.scrollHeight, behavior: 'smooth'});
                        });
                    }
                } catch (e) {
                    console.log(e);
                }
            },
            pushMessage(data){
                this.messages.push(data);
                this.$nextTick(() => {
                    const element = document.querySelector('.simplebar-content-wrapper');
                    element.scrollTo({top: element.scrollHeight, behavior: 'smooth'});
                });
            },
            getTime() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // getMonth() 0 dan boshlaydi, shuning uchun 1 qo'shamiz
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                return `${year}-${month}-${day} ${hours}:${minutes}`;
            },
        },
        mounted() {
            this.getUserMessages()
            this.connectWebSocket()
        }

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
