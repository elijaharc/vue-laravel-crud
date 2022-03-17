<template>
    <div class="container" id="home-container">
        <div class="jumbotron text-center text-white mt-5">
            <p class="text-dark mb-3" id="helloGuest">Hello, <span>{{ username ? username : 'Guest' }}!</span></p>
            <h1 class="lead text-dark display-4" id="brand">Welcome to <span class="app-name">TaskApp</span>.</h1>
            <hr class="text-muted mb-2 w-50 m-auto" id="lineBreak">
            <p class="text-muted mt-3 mb-3">Click the {{ isLoggedIn ? '"Tasks"' : '"Register"' }} button to begin.</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            username: "",
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
            this.username = window.Laravel.user.username
        }
    },
    methods: {}
}
</script>

<style>
    .app-name {
        color: green;
    }
</style>