import {GET, POSTFile} from '@/helpers/Config.js';
import {POST} from '@/helpers/Config.js';
import {PUT} from '@/helpers/Config.js';
import {DELETE} from '@/helpers/Config.js';

export const GetUser = async () => {
    return  GET('/user');
};
export const resetPassword = async () => {
    return  GET('/reset-password');
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

export const updateCurrency = async (data) => {
    return  POST('/setting/update-currency', data );
};

// --------------------- currency finished --------------------------------------------

