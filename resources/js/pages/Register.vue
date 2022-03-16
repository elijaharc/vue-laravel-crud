<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                    <FormKit type="group" :actions="false">
                        <FormKit
                            type="email"
                            label="Email address"
                            validation="required|email"
                            help="Enter your email address"
                            v-model="email"
                        />
                        <FormKit
                            type="password"
                            name="password"
                            value="super-secret"
                            label="Password"
                            help="Enter your password"
                            validation="required"
                            v-model="password"
                        />
                        <FormKit
                            type="password"
                            name="password_confirm"
                            label="Confirm password"
                            help="Confirm your password"
                            validation="required|confirm"
                            validation-label="Password confirmation"
                            v-model="password_confirm"
                        />
                        <button class="btn btn-primary" type="submit" @click="handleSubmit">Login</button>
                    </FormKit>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserService from '../services/user.service';
export default {
    data() {
        return {
            email: "",
            password: "",
            password_confirm: "",
            error: null,
            disabled: true
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            let user = {
                email: this.email,
                password: this.password,
                password_confirm: this.password_confirm
            }
            let validEmail = this.validateEmail(this.email)
            let passwordMatch = this.password === this.password_confirm
            if(this.email.length == 0 || this.password.length == 0 || this.password_confirm.length == 0) {
                this.error = "All fields required."
            } else if (!validEmail) {
                this.error = "Please enter a valid email address."   
            } else if (!passwordMatch){
                this.error = "Passwords do not match."
            } else {
                UserService.registerUser(user)
                    .then(response => {
                        console.log("response", response)
                        if (response.data.success) {
                            UserService.loginUser(user)
                            .then(response => {
                                if (response.data.success == true) {
                                    this.$router.push('/dashboard')
                                }
                            })
                        } else if (response.data.message.includes("Duplicate entry")){
                            this.error = "Email already registered."
                        } else {
                            console.log("Error:", response.data.message)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        },
        validateEmail(email){
            let pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            if(email != null || email != undefined || email != "") {
                return pattern.test(email)
            }
            return false
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        next();
    },
    mounted() {
        console.log("this.error", this.error)
    },
}
</script>