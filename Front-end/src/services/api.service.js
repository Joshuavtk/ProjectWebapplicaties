import { axios } from "@/helpers/axios";

export const apiService = {
    doPostCall,
    doGetCall
}

function doPostCall(uri, body = {}) {
    return axios.post(uri, body, {
        headers: {
            "content-type": "text/json"
        }
    })
}

function doPostCallAuthorized() {

}


function doGetCall(uri) {
    return axios.get(uri, {
        headers: {
            "content-type": "text/json"
        }
    })
}
