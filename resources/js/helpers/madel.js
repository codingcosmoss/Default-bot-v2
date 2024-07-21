// --------------------- warehouse_category started--------------------------------------------

export const warehouse_categorys = async () => {
    return  GET('warehouse-category/index');
};
export const warehouse_categoryActives = async () => {
    return  GET('warehouse-category/actives');
};
export const warehouse_categoryPaginates = async (count, page= 1) => {
    return  GET('warehouse-category/paginate/' + count+'?page='+page);
};
export const warehouse_categoryOrderBys = async (column, type) => {
    return  GET('warehouse-category/orderBy/' + column + '/' + type);
};
export const warehouse_categoryShow = async (id) => {
    return  GET('warehouse-category/show/'+id);
};
export const warehouse_categoryCreate = async (data) => {
    return  POST('warehouse-category/create', data );
};
export const warehouse_categoryUpdate = async (id, data) => {
    return  POST('warehouse-category/update/'+id, data );
};
export const warehouse_categorySearch = async (text) => {
    return  GET('warehouse-category/search/' + text );
};
export const warehouse_categoryDelete = async (id) => {
    return  GET('warehouse-category/delete/'+ id );
};

// --------------------- warehouse_category finished --------------------------------------------

