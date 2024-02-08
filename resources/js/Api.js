import {GET} from './Config.js';
import {POST} from './Config.js';
import {PUT} from './Config.js';
import {DELETE} from './Config.js';

export const Test = async () => {
    return  GET('/test');
};

export const GetUser = async () => {
    return  GET('/user');
};

export const Login = async (data) => {
    return  POST('/login', data);
};


export const Logout = async () => {
    return  GET('/logout');
};
export const testLogin = async ($data) => {
    return  POST('employee/test-login', $data);
};

export const employeeCreate = async ($data) => {
    return  POST('employee/create', $data);
};

export const Employees = async () => {
    return  GET('/employee/index');
};
export const showEmployee = async (data) => {
    return  GET('/employee/show/'+data);
};
export const updateEmployee = async (id, data) => {
    return  POST('/employee/update/'+id, data );
};

export const searchEmployee = async (data) => {
    return  POST('/employee/search', data );
};



