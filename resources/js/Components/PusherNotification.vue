<template>
    <div>
        <h1>Pusher Example</h1>
        <ul>
            <li v-for="message in messages" :key="message.id">
                {{ message.text }}
            </li>
        </ul>
    </div>
</template>

<script>
import Pusher from "pusher-js";

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
            const pusher = new Pusher("c6401e5016523495976b", {
                cluster: "us2",
                //   encrypted: true,
            });

            const channel = pusher.subscribe("my-channel");
            channel.bind("meal-status", (data) => {
                console.log(this.messages.push(JSON.stringify(data)));
                alert(); 
            });
        },
    },
};
</script>
