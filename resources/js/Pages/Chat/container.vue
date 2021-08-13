<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <!--Todo: Step 9-->
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)">
                </chat-room-selection>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!--                    Container-->
                    <!--Todo: Step 1-->
                    <div style="height: 300px">
                        <message-container :messages="messages"/>
                    </div>
                    <!--Todo: Step 6-->
                    <input-message :room="currentRoom"
                                   v-on:messagesent="getMessages()"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import MessageContainer from "./messageContainer";
import InputMessage from "./inputMessage";
import ChatRoomSelection from "./chatRoomSelection";

export default {
    //Todo: Step 1
    components: {
        ChatRoomSelection,
        InputMessage,
        MessageContainer,
        AppLayout,
    },
    //Todo: Step 2
    data: function () {
        return {
            chatRooms: [],
            currentRoom: [],
            messages: [],

        }
    },

    methods: {
        connect() {
            if (this.currentRoom.id) {
                let vm = this;
                //Todo: Step 8.1
                this.getMessages();
                window.Echo.private("chat." + this.currentRoom.id)
                    .listen('.message.new', e => {
                        vm.getMessages();
                    });
            }
        },
        disconnect(room) {
            window.Echo.leave("chat." + room.id);
        },

        //Todo: Step 4
        getRooms() {
            axios.get('/chat/rooms').then((response) => {
                this.chatRooms = response.data;
                this.setRoom(response.data[0]);
            }).catch((error) => {
                console.log(error);
            })
        },

        //Todo: Step 3
        setRoom(room) {
            this.currentRoom = room;
            //Todo: Step 8
            this.getMessages();
        },
        //Todo: Step 7
        getMessages() {
            axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then((response) => {
                    console.log(response.data);
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error)
                })
        },
    },
    watch: {
        currentRoom(val, oldVal) {
            if (oldVal.id) {
                this.disconnect(oldVal);
                console.log('oldVal');
                console.log(oldVal);
            }
            // this.connect(2);
            console.log('connect');
        }
    },
    mounted() {
        // .listen('message.new', (e) => {
        window.Echo.private('chat')
            .listen('NewChatMessage', (e) => {
                console.log(e);
                console.log(e.chatMessage);
                this.messages.push(e.chatMessage);
                alert('message.new')
                this.getMessages();
            });
    },
    created() {
        //Todo: Step 5
        this.getRooms()

    },
}
</script>
