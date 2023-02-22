<template>
    <div>
        <ul>
            <li v-for="message in state.messages" :key="message.id">
                {{ message.user.name }} - {{ message.message }}
            </li>
        </ul>
        <form @submit.prevent="send">
            <input type="text" v-model="state.message">
            <button type="submit">Send</button>
        </form>
    </div>
</template>

<script setup>

//create a message components
import Pusher from 'pusher-js'
import { reactive, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    loadMessage: Object
})

const state = useForm({
    messages: [],
    message: ''
});
const send = () => {
    state.post('/message', {
        preserveScroll: true,
        onSuccess: () => state.reset('message')
    })
}

const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true
});

onMounted(() => {
    pusher.subscribe('messages').bind('newMessage', (data) => {
        state.messages.push(data)
    });
});

onMounted(() => {
    props.loadMessage.map((m) => {
        return state.messages.push(m)
    })
})
</script>
