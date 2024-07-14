// --------------------- menu started--------------------------------------------

export const menus = async () => {
    return  GET('/menu/index');
};
export const menuActives = async () => {
    return  GET('/menu/actives');
};
export const menuPaginates = async (count, page= 1) => {
    return  GET('/menu/paginate/' + count+'?page='+page);
};
export const menuOrderBys = async (column, type) => {
    return  GET('/menu/orderBy/' + column + '/' + type);
};
export const menuShow = async (id) => {
    return  GET('/menu/show/'+id);
};
export const menuCreate = async (data) => {
    return  POST('/menu/create', data );
};
export const menuUpdate = async (id, data) => {
    return  POST('/menu/update/'+id, data );
};
export const menuSearch = async (text) => {
    return  GET('/menu/search/' + text );
};
export const menuDelete = async (id) => {
    return  GET('/menu/delete/'+ id );
};

// --------------------- menu finished --------------------------------------------
