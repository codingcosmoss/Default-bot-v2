// --------------------- invoice started--------------------------------------------

export const invoices = async () => {
    return  GET('/invoice/index');
};
export const invoiceActives = async () => {
    return  GET('/invoice/actives');
};
export const invoicePaginates = async (count, page= 1) => {
    return  GET('/invoice/paginate/' + count+'?page='+page);
};
export const invoiceOrderBys = async (column, type) => {
    return  GET('/invoice/orderBy/' + column + '/' + type);
};
export const invoiceShow = async (id) => {
    return  GET('/invoice/show/'+id);
};
export const invoiceCreate = async (data) => {
    return  POST('/invoice/create', data );
};
export const invoiceUpdate = async (id, data) => {
    return  POST('/invoice/update/'+id, data );
};
export const invoiceSearch = async (text) => {
    return  GET('/invoice/search/' + text );
};
export const invoiceDelete = async (id) => {
    return  GET('/invoice/delete/'+ id );
};

// --------------------- invoice finished --------------------------------------------

