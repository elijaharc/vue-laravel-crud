import axios from 'axios';

class TaskService {

    async addTask(task) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.post('api/tasks', task);
    }
}

export default new TaskService();
