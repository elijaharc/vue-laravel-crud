<template>
    <div>
        <h4 class="text-center">Edit Task</h4>
        <div class="row">
            <div class="col-6 mx-auto">
                <form @submit.prevent="updateTask">
                    <b-card border-variant="secondary" header="Task Name" class="text-center mx-auto my-4 d-flex">
                        <b-card-text><input type="text" class="form-control" v-model="task.task_name"></b-card-text>
                        <button type="submit" class="btn btn-primary">Update Task</button>
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
            task: {}
        }
    },
    created() {
        let taskId = this.$route.params.id;
        TaskService.editTask(taskId)
            .then(response => {
                this.task = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        updateTask() {
            TaskService.updateTask(this.task)
                .then(response => {
                    if(response.data.success){
                        this.$router.push('/tasks')
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
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