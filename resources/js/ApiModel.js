// ____________________________ word ________________________________________________________


import {GET} from "@/Config.js";

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

