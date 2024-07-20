// --------------------- drug_company started--------------------------------------------

export const drug_companys = async () => {
    return  GET('/drug-company/index');
};
export const drug_companyActives = async () => {
    return  GET('/drug-company/actives');
};
export const drug_companyPaginates = async (count, page= 1) => {
    return  GET('/drug-company/paginate/' + count+'?page='+page);
};
export const drug_companyOrderBys = async (column, type) => {
    return  GET('/drug-company/orderBy/' + column + '/' + type);
};
export const drug_companyShow = async (id) => {
    return  GET('/drug-company/show/'+id);
};
export const drug_companyCreate = async (data) => {
    return  POST('/drug-company/create', data );
};
export const drug_companyUpdate = async (id, data) => {
    return  POST('/drug-company/update/'+id, data );
};
export const drug_companySearch = async (text) => {
    return  GET('/drug-company/search/' + text );
};
export const drug_companyDelete = async (id) => {
    return  GET('/drug-company/delete/'+ id );
};

// --------------------- drug_company finished --------------------------------------------

