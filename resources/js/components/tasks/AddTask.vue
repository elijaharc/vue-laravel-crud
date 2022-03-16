<template>
    <div>
        <h4 class="text-center">Add Task</h4>
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>
                <form @submit.prevent="addTask">
                    <b-card border-variant="secondary" header="Task Name" class="text-center mx-auto my-4 d-flex">
                        <b-card-text><input type="text" class="form-control" v-model="task.task_name"></b-card-text>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </b-card>
                </form>
                <div class="d-flex justify-content-center">
                    <router-link :to="{ path: '/tasks' }">Back</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TaskService from '../../services/task.service';
export default {
    data() {
        return {
            task: {},
            error: null
        }
    },
    methods: {
        addTask() {
            let data = {
                taskName: this.task.task_name,
                userId: window.Laravel.user.id
            }

            if(this.task.task_name != undefined) {
                TaskService.addTask(data)
                    .then(response => {
                        if(response.data.success){
                            this.$router.push('/tasks')
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            } else {
                this.error = "Task name is required."
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>