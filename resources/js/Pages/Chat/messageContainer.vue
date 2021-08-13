<template>

    <div class="h-95 w-full">
        <div class="h-full p-2 flex flex-col-reverse overflow-y-auto">
            <div v-for="(message, index) in messages" :key="index">
                <message-item :message="message"></message-item>
            </div>
        </div>
    </div>


    <!--<h2>
        messageContainer
    </h2>-->
</template>

<script>
import MessageItem from "./messageItem";

export default {
    name: 'messageContainer',
    components: {MessageItem},
    props: ['messages']
}
</script>
