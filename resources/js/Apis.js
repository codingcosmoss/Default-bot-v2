// ____________________________ owedTreatment ________________________________________________________


export const owedTreatments = async (id, pages) => {
    if (id != null){
        return  GET('owed-treatment/index?page='+id+'&pages='+pages);
    }else {
        return  GET('owed-treatment/index?pages='+pages);
    }
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

