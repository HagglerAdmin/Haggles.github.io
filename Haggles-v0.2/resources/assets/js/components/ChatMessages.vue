<template>
    <div>
        <div class="msg" v-for="message in messages" :key="message">
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
</template>

<script>

export default {
    props: ['messages'],
}
</script>