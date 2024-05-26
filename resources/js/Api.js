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

// ____________________________ saved-word ________________________________________________________



export const savedWords = async (page, count) => {
    return  GET('saved-word/index?page='+ page + '&count=' + count);
};

export const savedWordShow = async (data) => {
    return  GET('saved-word/show/'+data);
};

export const savedWordFirst = async () => {
    return  GET('saved-word/first');
};

export const savedWordCreate = async (data) => {
    return  POST('saved-word/create', data );
};
export const savedWordUpdate = async (id, data) => {
    return  POST('saved-word/update/'+id, data );
};

export const savedWordSearch = async (data) => {
    return  POST('saved-word/search', data );
};

export const savedWordDelete = async (data) => {
    return  GET('saved-word/delete/'+ data );
};



// ____________________________ source ________________________________________________________


export const sources = async (page, count) => {
    return  GET('source/index?page='+ page + '&count=' + count);
};

export const sourceShow = async (data) => {
    return  GET('source/show/'+data);
};

export const sourceCreate = async (data) => {
    return  POST('source/create', data );
};
export const sourceUpdate = async (id, data) => {
    return  POST('source/update/'+id, data );
};

export const sourceSearch = async (data) => {
    return  POST('source/search', data );
};

export const sourceDelete = async (data) => {
    return  GET('source/delete/'+ data );
};



