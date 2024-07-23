// --------------------- document started--------------------------------------------

export const documents = async () => {
    return  GET('/document/index');
};
export const documentActives = async () => {
    return  GET('/document/actives');
};
export const documentPaginates = async (count, page= 1) => {
    return  GET('/document/paginate/' + count+'?page='+page);
};
export const documentOrderBys = async (column, type) => {
    return  GET('/document/orderBy/' + column + '/' + type);
};
export const documentShow = async (id) => {
    return  GET('/document/show/'+id);
};
export const documentCreate = async (data) => {
    return  POST('/document/create', data );
};
export const documentUpdate = async (id, data) => {
    return  POST('/document/update/'+id, data );
};
export const documentSearch = async (text) => {
    return  GET('/document/search/' + text );
};
export const documentDelete = async (id) => {
    return  GET('/document/delete/'+ id );
};

// --------------------- document finished --------------------------------------------

