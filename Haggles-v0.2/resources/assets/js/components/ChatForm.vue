<template>
    <div class="send-message">
        <div class="message-text">
            <textarea class="no-resize-bar form-control" rows="2" placeholder="Write a message..."  name="message" v-model="newMessage" @keyup.enter="sendMessage"></textarea>
        </div>
        <div class="send-button">
            <button class="btn" @click="sendMessage">Send <i class="fa fa-send"></i></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: '',
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>