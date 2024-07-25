// --------------------- imported_medicine started--------------------------------------------

export const imported_medicines = async () => {
    return  GET('imported-medicine/index');
};
export const imported_medicineActives = async () => {
    return  GET('imported-medicine/actives');
};
export const imported_medicinePaginates = async (count, page= 1) => {
    return  GET('imported-medicine/paginate/' + count+'?page='+page);
};
export const imported_medicineOrderBys = async (column, type) => {
    return  GET('imported-medicine/orderBy/' + column + '/' + type);
};
export const imported_medicineShow = async (id) => {
    return  GET('imported-medicine/show/'+id);
};
export const imported_medicineCreate = async (data) => {
    return  POST('imported-medicine/create', data );
};
export const imported_medicineUpdate = async (id, data) => {
    return  POST('imported-medicine/update/'+id, data );
};
export const imported_medicineSearch = async (text) => {
    return  GET('imported-medicine/search/' + text );
};
export const imported_medicineDelete = async (id) => {
    return  GET('imported-medicine/delete/'+ id );
};

// --------------------- imported_medicine finished --------------------------------------------

