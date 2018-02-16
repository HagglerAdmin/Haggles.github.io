<template>
    <form v-on:submit.prevent="registerUser" method="Post">
        
        <div v-bind:class="{'form-group': true, 'has-error': errors.username}">
            <label for="">Username:</label>
            <input type="text" class="form-control" v-model="register.username" placeholder="Enter your username">
            <span v-if="errors.username" class="help-block">{{ errors.username[0] }}</span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
            <label for="">Name:</label>
            <input type="text" class="form-control" v-model="register.name" placeholder="Enter your real name or store name">
            <span v-if="errors.name" class="help-block"> {{ errors.name[0] }} </span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.email_address}">
            <label for="">Email Address:</label>
            <input type="email" class="form-control" v-model="register.email_address" placeholder="Enter your email address">
            <span v-if="errors.email_address" class="help-block"> {{ errors.email_address[0] }} </span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.phonenumber}">
            <label for="">Phone number:</label>
            <input type="text" class="form-control" v-model="register.phonenumber" placeholder="Enter your phone number">
            <span v-if="errors.phonenumber" class="help-block"> {{ errors.phonenumber[0] }} </span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.password}">
            <label for="">Password:</label>
            <input type="password" class="form-control" v-model="register.password">
            <span v-if="errors.password" class="help-block"> {{ errors.password[0] }} </span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.repassword}">
            <label for="">Re-type Password:</label>
            <input type="password" class="form-control" v-model="register.repassword">
            <span v-if="errors.repassword" class="help-block"> {{ errors.repassword[0] }} </span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn red-btn btn-default">Register</button>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                register: {
                    username: '',
                    name: '',
                    email_address: '',
                    phonenumber: '',
                    password: '',
                    repassword: '',
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
            }
        },

        methods: {

            registerUser() {

                axios.post('/register', this.register)
                .then(response => {

                    window.location.href = "/";
                }, error => {
                    
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>