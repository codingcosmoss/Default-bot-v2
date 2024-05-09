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
export const Register = async (data) => {
    return  POST('/register', data);
};
export const Logout = async () => {
    return  GET('/logout');
};
export const phrases = async () => {
    return  GET('/phrase/index');
};

// ____________________________ topic ________________________________________________________


export const topics = async (page, count) => {
    return  GET('topic/index?page='+ page + '&count=' + count);
};

export const topicShow = async (data) => {
    return  GET('topic/show/'+data);
};

export const topicCreate = async (data) => {
    return  POST('topic/create', data );
};
export const topicUpdate = async (id, data) => {
    return  POST('topic/update/'+id, data );
};

export const topicSearch = async (data) => {
    return  POST('topic/search', data );
};

export const topicDelete = async (data) => {
    return  GET('topic/delete/'+ data );
};


// ____________________________ word ________________________________________________________

export const words = async (page, count) => {
    return  GET('word/index?page='+ page + '&count=' + count);
};

export const wordShow = async (data) => {
    return  GET('word/show/'+data);
};

export const wordCreate = async (data) => {
    return  POST('word/create', data );
};
export const wordUpdate = async (id, data) => {
    return  POST('word/update/'+id, data );
};

export const wordSearch = async (data) => {
    return  POST('word/search', data );
};

export const wordDelete = async (data) => {
    return  GET('word/delete/'+ data );
};





