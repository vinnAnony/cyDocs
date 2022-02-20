const axios = require('axios');
const url = axios.create({
    baseURL: 'http://cyDocs.appp/api/',
    headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${JSON.parse(localStorage.getItem('cyDocsToken'))}`
    }
})
export default url;
