<template>
    <form v-on:submit.prevent="loginUser" method="post">

        <span v-if="passerror" class="help-block" style="color:#a94442;">{{ passerror }}</span>
        <span v-if="existanceError" class="help-block" style="color:#a94442;">{{ existanceError }}</span>

        <div v-bind:class="{'form-group': true, 'has-error': errors.username}">
            <label>Username:</label>
            <input type="text" v-model="data.username" class="form-control" placeholder="Enter user name"/>
            <span v-if="errors.username" class="help-block">{{ errors.username[0] }}</span>
        </div>

        <div v-bind:class="{'form-group': true, 'has-error': errors.password}">
            <label>Password:</label>
            <input type="password" v-model="data.password" class="form-control"/>
            <span v-if="errors.password" class="help-block">{{ errors.password[0] }}</span>
         </div>
       
        <div class="form-group">
            <button type="submit" class="btn red-btn btn-default">Login</button>
        </div>

    </form>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                passerror: '',
                existanceError: '',
                data: {
                    username: '',
                    password: ''
                }
            }
        },

        methods: {
            loginUser() {
                
                axios.post('/login/user', this.data)
                .then(response => {
                    
                    this.errors = " ";
                    this.passerror = " ";
                    this.existanceError = " ";
                    if(response.data.includes("Check your Username or Password")) {
                        
                        this.passerror = response.data;
                    }
                    else if (response.data.includes("Account does'nt exist")) {

                        this.existanceError = response.data;
                    }
                    else {

                        window.location.href = "/";
                    }
                }, error => {
                    
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
