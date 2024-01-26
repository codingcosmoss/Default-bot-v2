import {GET} from './Config.js';
import {POST} from './Config.js';

export const Test = async () => {
    return  GET('/test');
};

export const GetUser = async () => {
    return  GET('/user');
};

export const Logout = async () => {
    return  GET('/logout');
};







