<template>

<div class="container fill" style="height:600px;">
    <div class="row chat-wrap">

        <!-- Contacts & Conversations -->
        <div class="col-sm-3 panel-wrap">

            <!--Left Menu / Conversation List-->
            <div class="col-sm-12 section-wrap">

                <!--Header-->
                <div class="row header-wrap">
                    <div class="chat-header col-sm-12">
                        <h4 id="username">Messages</h4>
                        <div class="header-button">
                            <a class="btn pull-right" href="#Contacts" data-toggle="collapse">
                                <i class="fa fa-pencil-square-o fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!--Conversations-->
                <div class="row content-wrap">
                    <div class="conversation btn">
                        <div class="media-body">
                            <h5 class="media-heading">Walter White</h5>
                            <small class="pull-right time">Last seen 12:10am</small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Messages & Info -->
        <div class="col-sm-9 panel-wrap">

            <!--Main Content / Message List-->
            <div class="col-sm-12 section-wrap" id="Messages">

                <!--Header-->
                <div class="row header-wrap">
                    <div class="chat-header col-sm-12">
                        <h4>Conversation Title</h4>
                        <div class="header-button">
                            <a class="btn pull-right info-btn">
                                <i class="fa fa-info-circle fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!--Messages-->
                <div class="row content-wrap messages">
                   <div class="msg" v-for="message in messages" :key="message" :message="message">
                            <div class="media-body">
                                <small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small>

                                <h5 class="media-heading">{{ message.user.name }}</h5>

                                <small class="col-sm-11">
                                    {{ message.message }}
                                </small>
                            </div>
                        </div>
                    </div>

                </div>        

                <!--Message box & Send Button-->
                <div class="row send-wrap">
                    <div class="send-message">
                        <div class="message-text">
                            <textarea class="no-resize-bar form-control" rows="2" placeholder="Write a message..."></textarea>
                        </div>
                        <div class="send-button">
                            <a class="btn">Send <i class="fa fa-send"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
  
</template>

<script>

export default {
    
}
</script>

<style>

</style>
