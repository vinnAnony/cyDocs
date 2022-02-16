const axios = require('axios');
const url = axios.create({
    baseURL: 'http://cyDocs.appp/api/',
    headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('jwToken')) : null}`
    }
})
export default url;
