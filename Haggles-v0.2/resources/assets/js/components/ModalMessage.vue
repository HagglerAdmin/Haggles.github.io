<template>
    <div>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Compose Message</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="pwd">Message to:</label>
                <input type="text" style="width:30%;" class="no-resize-bar form-control" name="message_to" v-model="messageTo"></textarea>
            </div>
            <div class="form-group">
                <label for="pwd">Type your message:</label>
                <textarea class="no-resize-bar form-control" rows="4" placeholder="Write a message..."  name="message" v-model="newMessage" @keyup.enter="sendMessage"></textarea>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"  @click="composeMessage">Close</button>
      </div>
    </div>
</template>

<script>
export default {
        props: ['user'],

        data() {
            return {
                newMessage: '',
                messageTo: '',
            }
        },

        methods: {
            composeMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    to: this.messageTo
                });

                this.newMessage = '';
                this.messageTo = '';
            }
        }    
    }
</script>