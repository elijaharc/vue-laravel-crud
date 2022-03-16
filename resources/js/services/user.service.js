import axios from 'axios';

class UserService {

    async loginUser(user) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.post('api/login', user);
    }

    async registerUser(user) {
        await axios.get('/sanctum/csrf-cookie');
        return axios.post('api/register', user);
    }
}

export default new UserService();
