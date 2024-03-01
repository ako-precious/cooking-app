<template>
    <div>
        <h1>Pusher Example</h1>
        <ul>
            <li v-for="(message, index) in messages" :key="index">
                {{ message }}
            </li>
        </ul>
    </div>
</template>

<script>
import Pusher from "pusher-js";
import Echo from 'laravel-echo';
export default {
    data() {
        return {
            messages: [],
        };
    },
    created() {
        this.setupPusher();
    },
    methods: {
        setupPusher() {
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: 'c6401e5016523495976b',
                cluster: 'us2',
                encrypted: true,
            });

            window.Echo.channel('my-channel')
                .listen('meal-status', (data) => {
                    this.messages.push(data.message);
                    alert(data.message);
                });
        },

        
    },
};

</script>
