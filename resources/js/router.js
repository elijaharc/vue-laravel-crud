import { createWebHistory, createRouter } from "vue-router";

import Home from './pages/Home.vue';
import Register from './pages/Register';
import Login from './pages/Login';
import Dashboard from './pages/Dashboard';

import Tasks from './components/tasks/Task';
import AddTask from './components/tasks/AddTask';
import EditTask from './components/tasks/EditTask';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'tasks',
        path: '/tasks',
        component: Tasks
    },
    {
        name: 'addtask',
        path: '/task/add',
        component: AddTask
    },
    {
        name: 'editask',
        path: '/task/edit/:id',
        component: EditTask
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;