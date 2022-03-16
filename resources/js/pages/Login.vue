<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default mt-5">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                    <FormKit
                        type="form"
                        submit-label="Login"
                        :actions="false"
                    >
                        <FormKit
                            name="email"
                            label="Email address"
                            validation="required|email"
                            v-model="email"
                        />
                        <FormKit
                            type="password"
                            name="password"
                            label="Password"
                            validation="required"
                            v-model="password"
                        />
                        <button class="btn btn-primary" @click="handleSubmit">Login</button>
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
            error: null
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            
            let user = {
                email: this.email,
                password: this.password
            }

            if (this.email.length > 0 && this.password.length > 0) {
                UserService.loginUser(user)
                    .then(response => {
                        if (response.data.success == true) {
                            this.$router.push('/dashboard')
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            } else {
                this.error = "Email and password are required"
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        //  <FormKit
        //                 type="email"
        //                 name="email"
        //                 label="Email address"
        //                 help="Enter your email address"
        //                 validation="required"
        //                 validation-visibility="submit"
        //                 v-model="email"
        //             />
        //             <FormKit
        //                 type="password"
        //                 name="password"
        //                 value="super-secret"
        //                 label="Password"
        //                 help="Enter your password"
        //                 validation="required"
        //                 validation-visibility="dirty"
        //                 v-model="password"
        //             />
        //             <FormKit
        //                 type="password"
        //                 name="password_confirm"
        //                 label="Confirm password"
        //                 help="Confirm your password"
        //                 validation="required|confirm"
        //                 validation-visibility="dirty"
        //                 validation-label="Password confirmation"
        //                 v-model="password_confirm"
        //             />
        //             </FormKit>
        //             <button :disabled="disabled" type="submit" class="btn btn-primary" @click="handleSubmit">
        //                 Register
        //             </button>
        next();
    }
}
</script>