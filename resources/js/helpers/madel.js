// --------------------- document_payment started--------------------------------------------

export const document_payments = async () => {
    return  GET('/document-payment/index');
};
export const document_paymentActives = async () => {
    return  GET('/document-payment/actives');
};
export const document_paymentPaginates = async (count, page= 1) => {
    return  GET('/document-payment/paginate/' + count+'?page='+page);
};
export const document_paymentOrderBys = async (column, type) => {
    return  GET('/document-payment/orderBy/' + column + '/' + type);
};
export const document_paymentShow = async (id) => {
    return  GET('/document-payment/show/'+id);
};
export const document_paymentCreate = async (data) => {
    return  POST('/document-payment/create', data );
};
export const document_paymentUpdate = async (id, data) => {
    return  POST('/document-payment/update/'+id, data );
};
export const document_paymentSearch = async (text) => {
    return  GET('/document-payment/search/' + text );
};
export const document_paymentDelete = async (id) => {
    return  GET('/document-payment/delete/'+ id );
};

// --------------------- document_payment finished --------------------------------------------

