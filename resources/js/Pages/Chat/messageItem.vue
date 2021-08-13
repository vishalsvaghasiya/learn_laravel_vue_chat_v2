<template>
    <div>
<!--        messageItem-->
        {{ message.user.name }}: {{ message.message }}
    </div>

</template>

<script>
export default {
    name: 'messageItem',
    props: ['message']
}
</script>
