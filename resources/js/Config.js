import axios from "axios";
import {useConterStore} from "./store/counter.js";

export const GET = async (url) => {
    try {
        const response = await axios.get(url,{
            headers: {
                Authorization: `Bearer ${localStorage.getItem('0008a78764c2')}`
            }
        });
        return response.data;
    } catch (error) {
        throw error;
    }

};

export const POST = async ( url, data = null) => {
    try {
        const response = await axios.post(url , data, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${localStorage.getItem('0008a78764c2')}`
            }
        });
        return response.data;
    } catch (error) {
        throw error;
    }
};
export const PUT = async ( url, data = null) => {
    try {
        const response = await axios.put(url , data, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${localStorage.getItem('0008a78764c2')}`
            }
        });
        return response.data;
    } catch (error) {
        throw error;
    }
};
export const DELETE = async ( url) => {
    try {
        const response = await axios.delete(url , {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${localStorage.getItem('0008a78764c2')}`
            }
        });
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const getName = (val) => {
    console.log(useConterStore().getLang(val))
}

// const formData = new FormData();
// formData.append('name', this.Title );
// formData.append('link', this.Author );
//
// for (let i = 0; i < this.Image.length; i++) {
//     formData.append('images[]', this.Image[i]);
// }
