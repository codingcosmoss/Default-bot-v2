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

