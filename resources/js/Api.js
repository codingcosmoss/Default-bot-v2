import {GET} from './Config.js';
import {POST} from './Config.js';
import {PUT} from './Config.js';
import {DELETE} from './Config.js';

export const GetUser = async () => {
    return  GET('/user');
};

export const Login = async (data) => {
    return  POST('/login', data);
};

export const Logout = async () => {
    return  GET('/logout');
};

