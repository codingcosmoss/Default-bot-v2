import {GET, POSTFile} from '@/helpers/Config.js';
import {POST} from '@/helpers/Config.js';
import {PUT} from '@/helpers/Config.js';
import {DELETE} from '@/helpers/Config.js';

export const GetUser = async () => {
    return  GET('/user');
};
export const GetPermissionUser = async () => {
    return  GET('/api/user');
};
export const Login = async (data) => {
    return  POST('/login', data);
};
export const Register = async (data) => {
    return  POST('/register', data);
};
export const Logout = async () => {
    return  GET('/logout');
};

// --------------------- user started--------------------------------------------

export const users = async () => {
    return  GET('/user/index');
};
export const userActives = async () => {
    return  GET('/user/actives');
};
export const userPaginates = async (count, page=1) => {
    return  GET('/user/paginate/' + count+'?page='+page);
};
export const userOrderBys = async (column, type) => {
    return  GET('/user/orderBy/' + column + '/' + type);
};
export const userShow = async (id) => {
    return  GET('/user/show/'+id);
};
export const userCreate = async (data) => {
    return  POSTFile('/user/create', data );
};
export const userUpdate = async (id, data) => {
    return  POSTFile('/user/update/'+id, data );
};
export const userProfilUpdate = async (id, data) => {
    return  POSTFile('/user/profil-update/'+id, data );
};
export const userUpdatePassword = async (id, data) => {
    return  POST('/user/update-password/'+id, data );
};

export const userSearch = async (text) => {
    return  GET('/user/search/' + text );
};
export const userDelete = async (id) => {
    return  GET('/user/delete/'+ id );
};

// --------------------- user finished --------------------------------------------

// --------------------- role started--------------------------------------------

export const roles = async () => {
    return  GET('/role/index');
};

export const roleNotification = async (id) => {
    return  GET('/role/notification/'+id);
};

export const roleActives = async () => {
    return  GET('/role/actives');
};
export const rolePaginates = async (count, page = 1) => {
    return  GET('/role/paginate/' + count+'?page='+page);
};
export const roleOrderBys = async (column, type) => {
    return  GET('/role/orderBy/' + column + '/' + type);
};
export const roleShow = async (id) => {
    return  GET('/role/show/'+id);
};
export const roleCreate = async (data) => {
    return  POST('/role/create', data );
};
export const roleUpdate = async (id, data) => {
    return  POST('/role/update/'+id, data );
};
export const roleSearch = async (text) => {
    return  GET('/role/search/' + text );
};
export const roleDelete = async (id) => {
    return  GET('/role/delete/'+ id );
};

// --------------------- role finished --------------------------------------------

// --------------------- menu started--------------------------------------------

export const menus = async () => {
    return  GET('/menu/index');
};
export const menuActives = async () => {
    return  GET('/menu/actives');
};
export const menuPaginates = async (count, page = 1) => {
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

// --------------------- setting started--------------------------------------------

export const settings = async () => {
    return  GET('/setting/index');
};
export const settingActives = async () => {
    return  GET('/setting/actives');
};
export const settingPaginates = async (count, page= 1) => {
    return  GET('/setting/paginate/' + count+'?page='+page);
};
export const settingOrderBys = async (column, type) => {
    return  GET('/setting/orderBy/' + column + '/' + type);
};
export const settingShow = async (id) => {
    return  GET('/setting/show/'+id);
};
export const settingCreate = async (data) => {
    return  POST('/setting/create', data );
};
export const settingUpdate = async (id, data) => {
    return  POSTFile('/setting/update/'+id, data );
};
export const settingSearch = async (text) => {
    return  GET('/setting/search/' + text );
};
export const settingDelete = async (id) => {
    return  GET('/setting/delete/'+ id );
};

// --------------------- setting finished --------------------------------------------


// --------------------- customer started--------------------------------------------

export const customers = async () => {
    return  GET('/customer/index');
};
export const customerActives = async () => {
    return  GET('/customer/actives');
};
export const customerPaginates = async (count, page= 1) => {
    return  GET('/customer/paginate/' + count+'?page='+page);
};
export const customerOrderBys = async (column, type) => {
    return  GET('/customer/orderBy/' + column + '/' + type);
};
export const customerShow = async (id) => {
    return  GET('/customer/show/'+id);
};
export const customerCreate = async (data) => {
    return  POSTFile('/customer/create', data );
};
export const customerUpdate = async (id, data) => {
    return  POSTFile('/customer/update/'+id, data );
};
export const customerSearch = async (text) => {
    return  GET('/customer/search/' + text );
};
export const customerDelete = async (id) => {
    return  GET('/customer/delete/'+ id );
};

// --------------------- customer finished --------------------------------------------


// --------------------- expense started--------------------------------------------

export const expenses = async () => {
    return  GET('/expense/index');
};

export const expenseTotal = async () => {
    return  GET('/expense/total');
};
export const getCategoryExpenses = async (id, page) => {
    return  GET('/expense/category-expenses/'+ id + '?page='+page);
};

export const expenseCurrencies = async (id) => {
    return  GET('/expense/currencies/'+id);
};
export const expenseActives = async () => {
    return  GET('/expense/actives');
};
export const expensePaginates = async (count, page= 1) => {
    return  GET('/expense/paginate/' + count+'?page='+page);
};
export const expenseOrderBys = async (column, type) => {
    return  GET('/expense/orderBy/' + column + '/' + type);
};
export const expenseShow = async (id) => {
    return  GET('/expense/show/'+id);
};
export const expenseCreate = async (data) => {
    return  POST('/expense/create', data );
};
export const expenseUpdate = async (id, data) => {
    return  POST('/expense/update/'+id, data );
};
export const expenseSearch = async (text) => {
    return  GET('/expense/search/' + text );
};
export const expenseDelete = async (id) => {
    return  GET('/expense/delete/'+ id );
};

// --------------------- expense finished --------------------------------------------

// --------------------- expense_category started--------------------------------------------

export const expense_categorys = async () => {
    return  GET('/expense_category/index');
};
export const expense_categoryActives = async () => {
    return  GET('/expense_category/actives');
};
export const expense_categoryPaginates = async (count, page= 1) => {
    return  GET('/expense_category/paginate/' + count+'?page='+page);
};
export const expense_categoryOrderBys = async (column, type) => {
    return  GET('/expense_category/orderBy/' + column + '/' + type);
};
export const expense_categoryShow = async (id) => {
    return  GET('/expense_category/show/'+id);
};
export const expense_categoryCreate = async (data) => {
    return  POST('/expense_category/create', data );
};
export const expense_categoryUpdate = async (id, data) => {
    return  POST('/expense_category/update/'+id, data );
};
export const expense_categorySearch = async (text) => {
    return  GET('/expense_category/search/' + text );
};
export const expense_categoryExpensesSearch = async (id, text) => {
    return  GET('/expense_category/expenses/' + id + '/' + text);
};
export const expense_categoryDelete = async (id) => {
    return  GET('/expense_category/delete/'+ id );
};

// --------------------- expense_category finished --------------------------------------------


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

// --------------------- supplier started--------------------------------------------

export const suppliers = async () => {
    return  GET('/supplier/index');
};
export const supplierActives = async () => {
    return  GET('/supplier/actives');
};
export const supplierPaginates = async (count, page= 1) => {
    return  GET('/supplier/paginate/' + count+'?page='+page);
};
export const supplierOrderBys = async (column, type) => {
    return  GET('/supplier/orderBy/' + column + '/' + type);
};
export const supplierShow = async (id) => {
    return  GET('/supplier/show/'+id);
};
export const supplierCreate = async (data) => {
    return  POSTFile('/supplier/create', data );
};
export const supplierUpdate = async (id, data) => {
    return  POSTFile('/supplier/update/'+id, data );
};
export const supplierSearch = async (text) => {
    return  GET('/supplier/search/' + text );
};
export const supplierDelete = async (id) => {
    return  GET('/supplier/delete/'+ id );
};

// --------------------- supplier finished --------------------------------------------

// --------------------- size_type started--------------------------------------------

export const size_types = async () => {
    return  GET('/size-type/index');
};
export const size_typeActives = async () => {
    return  GET('/size-type/actives');
};
export const size_typePaginates = async (count, page= 1) => {
    return  GET('/size-type/paginate/' + count+'?page='+page);
};
export const size_typeOrderBys = async (column, type) => {
    return  GET('/size-type/orderBy/' + column + '/' + type);
};
export const size_typeShow = async (id) => {
    return  GET('/size-type/show/'+id);
};
export const size_typeCreate = async (data) => {
    return  POST('/size-type/create', data );
};
export const size_typeUpdate = async (id, data) => {
    return  POST('/size-type/update/'+id, data );
};
export const size_typeSearch = async (text) => {
    return  GET('/size-type/search/' + text );
};
export const size_typeDelete = async (id) => {
    return  GET('/size-type/delete/'+ id );
};

// --------------------- size_type finished --------------------------------------------
// --------------------- box_size started--------------------------------------------

export const box_sizes = async () => {
    return  GET('/box-size/index');
};
export const box_sizeActives = async () => {
    return  GET('/box-size/actives');
};
export const box_sizePaginates = async (count, page= 1) => {
    return  GET('/box-size/paginate/' + count+'?page='+page);
};
export const box_sizeOrderBys = async (column, type) => {
    return  GET('/box-size/orderBy/' + column + '/' + type);
};
export const box_sizeShow = async (id) => {
    return  GET('/box-size/show/'+id);
};
export const box_sizeCreate = async (data) => {
    return  POST('/box-size/create', data );
};
export const box_sizeUpdate = async (id, data) => {
    return  POST('/box-size/update/'+id, data );
};
export const box_sizeSearch = async (text) => {
    return  GET('/box-size/search/' + text );
};
export const box_sizeDelete = async (id) => {
    return  GET('/box-size/delete/'+ id );
};

// --------------------- box_size finished --------------------------------------------

// --------------------- medicine_category started--------------------------------------------

export const medicine_categorys = async () => {
    return  GET('/medicine-category/index');
};
export const medicine_categoryActives = async () => {
    return  GET('/medicine-category/actives');
};
export const medicine_categoryPaginates = async (count, page= 1) => {
    return  GET('/medicine-category/paginate/' + count+'?page='+page);
};
export const medicine_categoryOrderBys = async (column, type) => {
    return  GET('/medicine-category/orderBy/' + column + '/' + type);
};
export const medicine_categoryShow = async (id) => {
    return  GET('/medicine-category/show/'+id);
};
export const medicine_categoryCreate = async (data) => {
    return  POST('/medicine-category/create', data );
};
export const medicine_categoryUpdate = async (id, data) => {
    return  POST('/medicine-category/update/'+id, data );
};
export const medicine_categorySearch = async (text) => {
    return  GET('/medicine-category/search/' + text );
};
export const medicine_categoryDelete = async (id) => {
    return  GET('/medicine-category/delete/'+ id );
};

// --------------------- medicine_category finished --------------------------------------------


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

