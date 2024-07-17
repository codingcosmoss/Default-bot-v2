// --------------------- currency started--------------------------------------------

export const currencys = async () => {
    return  GET('/currency/index');
};
export const currencyActives = async () => {
    return  GET('/currency/actives');
};
export const currencyPaginates = async (count, page= 1) => {
    return  GET('/currency/paginate/' + count+'?page='+page);
};
export const currencyOrderBys = async (column, type) => {
    return  GET('/currency/orderBy/' + column + '/' + type);
};
export const currencyShow = async (id) => {
    return  GET('/currency/show/'+id);
};
export const currencyCreate = async (data) => {
    return  POST('/currency/create', data );
};
export const currencyUpdate = async (id, data) => {
    return  POST('/currency/update/'+id, data );
};
export const currencySearch = async (text) => {
    return  GET('/currency/search/' + text );
};
export const currencyDelete = async (id) => {
    return  GET('/currency/delete/'+ id );
};

// --------------------- currency finished --------------------------------------------

