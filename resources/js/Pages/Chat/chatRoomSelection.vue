<template>
    <!--    <h2>
            chatRoomSelection
        </h2>-->

    <div class="grid grid-cols-2">
        <div class="font-bold text-xl">
            {{ selected.name }} chat
        </div>

        <div>
            <select name="" id=""
                    v-model="selected"
                    @change="$emit('roomChanged' , selected)"
                    class="float-right">

                <option
                    v-for="(room , index) in rooms"
                    :key="index"
                    :value="room">
                    {{room.name}}
                </option>
            </select>

        </div>
    </div>
</template>

<script>
export default {
    name: 'chatRoomSelection',
    props: ['rooms', 'currentRoom'],
    data() {
        return {
            selected: ''
        }
    },
    created() {
        this.selected = this.currentRoom;
    }
}
</script>
