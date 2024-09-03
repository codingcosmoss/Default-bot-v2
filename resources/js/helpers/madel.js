// --------------------- expired started--------------------------------------------

export const expireds = async () => {
    return  GET('/expired/index');
};
export const expiredActives = async () => {
    return  GET('/expired/actives');
};
export const expiredPaginates = async (count, page= 1) => {
    return  GET('/expired/paginate/' + count+'?page='+page);
};
export const expiredOrderBys = async (column, type) => {
    return  GET('/expired/orderBy/' + column + '/' + type);
};
export const expiredShow = async (id) => {
    return  GET('/expired/show/'+id);
};
export const expiredCreate = async (data) => {
    return  POST('/expired/create', data );
};
export const expiredUpdate = async (id, data) => {
    return  POST('/expired/update/'+id, data );
};
export const expiredSearch = async (text) => {
    return  GET('/expired/search/' + text );
};
export const expiredDelete = async (id) => {
    return  GET('/expired/delete/'+ id );
};

// --------------------- expired finished --------------------------------------------

