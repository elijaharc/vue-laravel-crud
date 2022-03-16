import axios from 'axios';

class TaskService {

    async getAllUserTasks() {
        await axios.get('/sanctum/csrf-cookie');
        return axios.get('api/task/' + window.Laravel.user.id);
    }

    async addTask(data) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.post('/api/task/add', data)
    }

    async editTask(taskId) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.get('/api/task/edit/' + taskId);
    }

    async updateTask(data) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.post('/api/task/update', data);
    }

    async deleteTask(taskId) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.delete('/api/task/delete/' + taskId);
    }
}

export default new TaskService();
