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

export const Login = async (data) => {
    return  POST('/login', data);
};


export const Logout = async () => {
    return  GET('/logout');
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


// Services

export const services = async (id, pages) => {
    return  GET('/service/index?page='+id+'&pages='+pages);
};

export const serviceShow = async (data) => {
    return  GET('/service/show/'+data);
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



