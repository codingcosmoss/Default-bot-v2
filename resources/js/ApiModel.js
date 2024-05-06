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

