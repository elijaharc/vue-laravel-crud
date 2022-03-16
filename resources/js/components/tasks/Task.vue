<template>
    <div>
        <div class="d-flex justify-content-between">
            <h4 class="text-center">Displaying Your Tasks</h4><br/>
            <button type="button" class="btn btn-primary" @click="this.$router.push('/task/add')">Add Task</button>
        </div>
        <b-card bg-variant="light" header="Task Name" class="text-center col-6 mx-auto my-4" v-for="task in tasks" :key="task.id">
            <b-card-text>{{ task.task_name }}</b-card-text>
            <div class="btn-group" role="group">
                <button class="btn btn-secondary btn-sm" @click="editTask(task.id)">Edit</button>
                <button class="btn btn-danger btn-sm" @click="deleteTask(task)">Delete</button>
            </div>
        </b-card>
    </div>
</template>

<script>
import TaskService from '../../services/task.service';
export default {
    data() {
        return {
            tasks: []
        }
    },
    created() {
        TaskService.getAllUserTasks()
            .then(response => {
                this.tasks = response.data
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        editTask(taskId) {
            this.$router.push('/task/edit/' + taskId);
        },
        deleteTask(task) {
            let id = task.id;
            TaskService.deleteTask(id)
                .then(response => {
                    if(response.data.success){
                        this.tasks.splice(this.tasks.indexOf(task), 1)
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