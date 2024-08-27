// --------------------- report started--------------------------------------------

export const reports = async () => {
    return  GET('/report/index');
};
export const reportActives = async () => {
    return  GET('/report/actives');
};
export const reportPaginates = async (count, page= 1) => {
    return  GET('/report/paginate/' + count+'?page='+page);
};
export const reportOrderBys = async (column, type) => {
    return  GET('/report/orderBy/' + column + '/' + type);
};
export const reportShow = async (id) => {
    return  GET('/report/show/'+id);
};
export const reportCreate = async (data) => {
    return  POST('/report/create', data );
};
export const reportUpdate = async (id, data) => {
    return  POST('/report/update/'+id, data );
};
export const reportSearch = async (text) => {
    return  GET('/report/search/' + text );
};
export const reportDelete = async (id) => {
    return  GET('/report/delete/'+ id );
};

// --------------------- report finished --------------------------------------------

