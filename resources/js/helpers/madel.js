// --------------------- returned_medicine started--------------------------------------------

export const returned_medicines = async () => {
    return  GET('/returned-medicine/index');
};
export const returned_medicineActives = async () => {
    return  GET('/returned-medicine/actives');
};
export const returned_medicinePaginates = async (count, page= 1) => {
    return  GET('/returned-medicine/paginate/' + count+'?page='+page);
};
export const returned_medicineOrderBys = async (column, type) => {
    return  GET('/returned-medicine/orderBy/' + column + '/' + type);
};
export const returned_medicineShow = async (id) => {
    return  GET('/returned-medicine/show/'+id);
};
export const returned_medicineCreate = async (data) => {
    return  POST('/returned-medicine/create', data );
};
export const returned_medicineUpdate = async (id, data) => {
    return  POST('/returned-medicine/update/'+id, data );
};
export const returned_medicineSearch = async (text) => {
    return  GET('/returned-medicine/search/' + text );
};
export const returned_medicineDelete = async (id) => {
    return  GET('/returned-medicine/delete/'+ id );
};

// --------------------- returned_medicine finished --------------------------------------------

