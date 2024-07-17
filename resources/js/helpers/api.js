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

