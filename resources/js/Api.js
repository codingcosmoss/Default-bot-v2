import {GET} from './Config.js';
import {POST} from './Config.js';
import {PUT} from './Config.js';
import {DELETE} from './Config.js';

export const Test = async () => {
    return  GET('/test');
};

export const GetUser = async () => {
    return  GET('/user');
};

export const getPermissions = async () => {
    return  GET('/employee/get-permissions');
};
export const getUserPermissions = async (id) => {
    return  GET('/employee/get-user-permissions/'+id);
};
export const getDashboardData = async () => {
    return  GET('/getDashboard');
};

export const Login = async (data) => {
    return  POST('/login', data);
};

export const saveWord = async (id) => {
    return  GET('treatmetn/save-word/' + id);
};


export const Logout = async () => {
    return  GET('/logout');
};
export const getMoonTreatments = async () => {
    return  GET('/get-moon-treatments');
};

export const testLogin = async ($data) => {
    return  POST('employee/test-login', $data);
};

export const employeeCreate = async (data) => {
    return  POST('employee/create', data);
};

export const Employees = async (id, pages) => {
    if (id == null) {
        return  GET('/employee/index?pages='+pages);
    }
    return  GET('/employee/index?page='+id+'&pages='+pages);
};
export const showEmployee = async (data) => {
    return  GET('/employee/show/'+data);
};

export const cancletedTreatment = async (data) => {
    return  POST('/treatmetn/closed', data);
};

export const updateEmployee = async (id, data) => {
    return  POST('/employee/update/'+id, data );
};

export const searchEmployee = async (data) => {
    return  POST('/employee/search', data );
};

export const deleteEmployee = async (data) => {
    return  GET('/employee/delete/'+ data );
};

export const updatePassword = async (data) => {
    return  POST('/employee/update-password', data );
};

export const permissions = async () => {
    return  GET('/permissions' );
};

// Services

export const services = async (id, pages) => {
    return  GET('/service/index?page='+id+'&pages='+pages);
};

export const serviceShow = async (data) => {
    return  GET('/service/show/'+data);
};
export const getEmployeeTreatments = async (id) => {
    return  GET('/treatmetn/employee/treatments/'+id);
};

export const serviceCreate = async (data) => {
    return  POST('/service/create', data );
};
export const serviceUpdate = async (id, data) => {
    return  POST('/service/update/'+id, data );
};

export const serviceSearch = async (data) => {
    return  POST('/service/search', data );
};

export const serviceDelete = async (data) => {
    return  GET('/service/delete/'+ data );
};




// Service Category
export const service_categorys = async (id, pages) => {
    if (id != null){
        return  GET('/service_category/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/service_category/index?pages='+pages);
    }
};

export const treatment_service_categorys = async (id) => {
    return  GET('/service_category/treatment/index/'+id);
};


export const service_categoryShow = async (data) => {
    return  GET('/service_category/show/'+data);
};

export const service_categoryCreate = async (data) => {
    return  POST('/service_category/create', data );
};
export const service_categoryUpdate = async (id, data) => {
    return  POST('/service_category/update/'+id, data );
};

export const service_categorySearch = async (data) => {
    return  POST('/service_category/search', data );
};

export const service_categoryDelete = async (data) => {
    return  GET('/service_category/delete/'+ data );
};

// Diseases

export const diseases = async (id, pages) => {
    if (id != null){
        return  GET('/disease/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/disease/index?pages='+pages);
    }
};

export const getDiseases = async (id, pages) => {
    if (id != null){
        return  GET('/disease/is-actives?page='+id+'&pages='+pages);
    }else {
        return  GET('/disease/is-actives?pages='+pages);
    }
};

export const diseaseShow = async (data) => {
    return  GET('/disease/show/'+data);
};

export const diseaseCreate = async (data) => {
    return  POST('/disease/create', data );
};
export const diseaseUpdate = async (id, data) => {
    return  POST('/disease/update/'+id, data );
};

export const diseasesSearch = async (data) => {
    return  POST('/disease/search', data );
};

export const diseaseDelete = async (data) => {
    return  GET('/disease/delete/'+ data );
};


// patients

export const patients = async (id, pages) => {
    if (id != null){
        return  GET('/patient/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/patient/index?pages='+pages);
    }
};

export const patientShow = async (data) => {
    return  GET('/patient/show/'+data);
};

export const patientCreate = async (data) => {
    return  POST('/patient/create', data );
};
export const patientUpdate = async (id, data) => {
    return  POST('/patient/update/'+id, data );
};

export const patientsSearch = async (data) => {
    return  POST('/patient/search', data );
};

export const patientDelete = async (data) => {
    return  GET('/patient/delete/'+ data );
};

export const joinDr = async (data) => {
    return  POST('patient/join-doctor', data );
};


// Treatment

export const Treatments = async (id, pages) => {
    if (id != null){
        return  GET('/treatmetn/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/treatmetn/index?pages='+pages);
    }
};

export const TreatmentShow = async (data) => {
    return  GET('/treatmetn/show/'+data);
};
export const treatmentSearch = async (data) => {
    return  POST('/treatmetn/search', data );
};
export const treatmentDiscount = async (data) => {
    return  POST('/treatmetn/discount', data );
};
// Payment types

export const PaymentTypes = async (id, pages) => {
    if (id != null){
        return  GET('/payment-type/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/payment-type/index?pages='+pages);
    }
};



export const paymentTypesShow = async (data) => {
    return  GET('/payment-type/show/'+data);
};

export const paymentTypesCreate = async (data) => {
    return  POST('/payment-type/create', data );
};
export const paymentTypesUpdate = async (id, data) => {
    return  POST('/payment-type/update/'+id, data );
};

export const paymentTypessSearch = async (data) => {
    return  POST('/payment-type/search', data );
};

export const paymentTypesDelete = async (data) => {
    return  GET('/payment-type/delete/'+ data );
};


// Payments

export const payments = async (id, pages) => {
    if (id != null){
        return  GET('/payment/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/payment/index?pages='+pages);
    }
};

export const paymentShow = async (data) => {
    return  GET('/payment/show/'+data);
};

export const paymentCreate = async (data) => {
    return  POST('/payment/create', data );
};
export const paymentUpdate = async (id, data) => {
    return  POST('/payment/update/'+id, data );
};

export const paymentsSearch = async (data) => {
    return  POST('/payment/search', data );
};

export const paymentDelete = async (data) => {
    return  GET('/payment/delete/'+ data );
};


// _______________________ Warehouse ________________________________________________________


export const warehouses = async (id, pages) => {
    if (id != null){
        return  GET('/warehouse/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/warehouse/index?pages='+pages);
    }
};



export const warehouseShow = async (data) => {
    return  GET('/warehouse/show/'+data);
};

export const warehouseCreate = async (data) => {
    return  POST('/warehouse/create', data );
};
export const warehouseUpdate = async (id, data) => {
    return  POST('/warehouse/update/'+id, data );
};

export const warehousesSearch = async (data) => {
    return  POST('/warehouse/search', data );
};

export const warehouseDelete = async (data) => {
    return  GET('/warehouse/delete/'+ data );
};


// ____________________________ filial ________________________________________________________


export const filials = async (id, pages) => {
    if (id != null){
        return  GET('/filial/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/filial/index?pages='+pages);
    }
};

export const filialShow = async (data) => {
    return  GET('/filial/show/'+data);
};

export const filialCreate = async (data) => {
    return  POST('/filial/create', data );
};
export const filialUpdate = async (id, data) => {
    return  POST('/filial/update/'+id, data );
};

export const filialsSearch = async (data) => {
    return  POST('/filial/search', data );
};

export const filialDelete = async (data) => {
    return  GET('/filial/delete/'+ data );
};

// ____________________________ warehouse-category ________________________________________________________


export const warehouseCategorys = async (id, pages) => {
    if (id != null){
        return  GET('/warehouse-category/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/warehouse-category/index?pages='+pages);
    }
};

export const warehouseCategoryShow = async (data) => {
    return  GET('/warehouse-category/show/'+data);
};

export const warehouseCategoryCreate = async (data) => {
    return  POST('/warehouse-category/create', data );
};
export const warehouseCategoryUpdate = async (id, data) => {
    return  POST('/warehouse-category/update/'+id, data );
};

export const warehouseCategorySearch = async (data) => {
    return  POST('/warehouse-category/search', data );
};

export const warehouseCategoryDelete = async (data) => {
    return  GET('/warehouse-category/delete/'+ data );
};

// ____________________________ group ________________________________________________________


export const groups = async (id, pages) => {
    if (id != null){
        return  GET('/group/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/group/index?pages='+pages);
    }
};

export const groupShow = async (data) => {
    return  GET('/group/show/'+data);
};

export const groupCreate = async (data) => {
    return  POST('/group/create', data );
};
export const groupUpdate = async (id, data) => {
    return  POST('/group/update/'+id, data );
};

export const groupSearch = async (data) => {
    return  POST('/group/search', data );
};

export const groupDelete = async (data) => {
    return  GET('/group/delete/'+ data );
};

// ____________________________ product ________________________________________________________


export const products = async (id, pages) => {
    if (id != null){
        return  GET('/product/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/product/index?pages='+pages);
    }
};

export const productShow = async (data) => {
    return  GET('/product/show/'+data);
};

export const productCreate = async (data) => {
    return  POST('/product/create', data );
};
export const productUpdate = async (id, data) => {
    return  POST('/product/update/'+id, data );
};

export const productSearch = async (data) => {
    return  POST('/product/search', data );
};

export const productDelete = async (data) => {
    return  GET('/product/delete/'+ data );
};


// ____________________________ collection ________________________________________________________


export const collections = async (id, pages) => {
    if (id != null){
        return  GET('/collection/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/collection/index?pages='+pages);
    }
};

export const collectionShow = async (data) => {
    return  GET('/collection/show/'+data);
};

export const collectionCreate = async (data) => {
    return  POST('/collection/create', data );
};
export const collectionUpdate = async (id, data) => {
    return  POST('/collection/update/'+id, data );
};

export const collectionSearch = async (data) => {
    return  POST('/collection/search', data );
};

export const collectionDelete = async (data) => {
    return  GET('/collection/delete/'+ data );
};

// ____________________________ productDocument ________________________________________________________


export const productDocuments = async (id, pages) => {
    if (id != null){
        return  GET('/product-document/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/product-document/index?pages='+pages);
    }
};

export const productDocumentShow = async (data) => {
    return  GET('/product-document/show/'+data);
};

export const productDocumentCreate = async (data) => {
    return  POST('/product-document/create', data );
};
export const productDocumentUpdate = async (id, data) => {
    return  POST('/product-document/update/'+id, data );
};

export const productDocumentSearch = async (data) => {
    return  POST('/product-document/search', data );
};

export const productDocumentDelete = async (data) => {
    return  GET('/product-document/delete/'+ data );
};




// ____________________________ supplier ________________________________________________________


export const suppliers = async (id, pages) => {
    if (id != null){
        return  GET('/supplier/index?page='+id+'&pages='+pages);
    }else {
        return  GET('/supplier/index?pages='+pages);
    }
};

export const supplierShow = async (data) => {
    return  GET('/supplier/show/'+data);
};

export const supplierCreate = async (data) => {
    return  POST('/supplier/create', data );
};
export const supplierUpdate = async (id, data) => {
    return  POST('/supplier/update/'+id, data );
};

export const supplierSearch = async (data) => {
    return  POST('/supplier/search', data );
};

export const supplierDelete = async (data) => {
    return  GET('/supplier/delete/'+ data );
};


export const importedProducts = async (data) => {
    return  POST('/imported-products', data );
};

export const getDocumentProducts = async (id) => {
    return  GET('/product-document/products/' +  id );
};


export const treatmentAddService = async (data) => {
    return  POST('/treatment-add-service', data );
};

export const treatmentAddServiceAll = async (id) => {
    return  GET('/treatment-add-all/'  +  id );
};

export const getUserPayments = async (id) => {
    return  GET('/get-user-payments/'  +  id );
};
export const getTreatmentUserPayments = async (data) => {
    return  POST('/get-user-treatment-payments/' , data );
};
export const treatmentSavedService = async (data) => {
    return  POST('/treatment-saved-service', data );
};



// ____________________________ owedTreatment ________________________________________________________


export const owedTreatments = async (id, pages) => {
    if (id != null){
        return  GET('owed-treatment/index?page='+id+'&pages='+pages);
    }else {
        return  GET('owed-treatment/index?pages='+pages);
    }
};

export const debtorTreatments = async (id, pages) => {
    if (id != null){
        return  GET('treatmetn/deptor/index?page='+id+'&pages='+pages);
    }else {
        return  GET('treatmetn/deptor/index?pages='+pages);
    }
};
export const deptorTreatmentSearch = async (data) => {
    return  POST('treatmetn/deptor/search', data );
};


export const owedTreatmentShow = async (data) => {
    return  GET('owed-treatment/show/'+data);
};

export const owedTreatmentCreate = async (data) => {
    return  POST('owed-treatment/create', data );
};
export const owedTreatmentUpdate = async (id, data) => {
    return  POST('owed-treatment/update/'+id, data );
};

export const owedTreatmentSearch = async (data) => {
    return  POST('owed-treatment/search', data );
};

export const owedTreatmentDelete = async (data) => {
    return  GET('owed-treatment/delete/'+ data );
};

export const treatmentFinished = async (data) => {
    return  GET('/treatment-finished/'+ data );
};

// ____________________________ telegram ________________________________________________________


export const telegrams = async (id, pages) => {
    if (id != null){
        return  GET('telegram/index?page='+id+'&pages='+pages);
    }else {
        return  GET('telegram/index?pages='+pages);
    }
};

export const telegramShow = async (data) => {
    return  GET('telegram/show/'+data);
};

export const telegramCreate = async (data) => {
    return  POST('telegram/create', data );
};
export const telegramUpdate = async (id, data) => {
    return  POST('telegram/update/'+id, data );
};

export const telegramSearch = async (data) => {
    return  POST('telegram/search', data );
};

export const telegramDelete = async (data) => {
    return  GET('telegram/delete/'+ data );
};

export const companySettingStore = async (data) => {
    return  POST('setting/company-store', data );
};
export const getCompany = async () => {
    return  GET('setting/company/show' );
};

export const getEmployeePayments = async () => {
    return  GET('/employee-payments' );
};
export const storeEmployeePayments = async (data) => {
    return  POST('/employee-payments/save', data );
};

export const showEmployeePayments = async (data) => {
    return  GET('/employee-payment/show/'+data);
};

export const givenMoneys = async () => {
    return  GET('/given-moneys');
};

export const givenMoneysSearch = async (data) => {
    return  POST('/given-moneys/search', data );
};


export const dalyTreatments = async (year, moon) => {
    return  GET('/daly-treatments/'+year+'/'+moon);
};

// ____________________________ daily-cost ________________________________________________________


export const dailyCosts = async (id, pages) => {
    if (id != null){
        return  GET('daily-cost/index?page='+id+'&pages='+pages);
    }else {
        return  GET('daily-cost/index?pages='+pages);
    }
};

export const dailyCostShow = async (data) => {
    return  GET('daily-cost/show/'+data);
};

export const dailyCostCreate = async (data) => {
    return  POST('daily-cost/create', data );
};
export const dailyCostUpdate = async (id, data) => {
    return  POST('daily-cost/update/'+id, data );
};

export const dailyCostSearch = async (data) => {
    return  POST('daily-cost/search', data );
};

export const dailyCostDelete = async (data) => {
    return  GET('daily-cost/delete/'+ data );
};
export const reports = async (start, end) => {
    return  GET('/reports/'+ start + '/' + end );
};



