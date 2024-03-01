// payments

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

