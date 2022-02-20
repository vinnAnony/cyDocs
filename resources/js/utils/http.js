const axios = require('axios');
const url = axios.create({
    baseURL: 'http://198.211.97.143/api/',
    headers: {
        'Accept': 'application/json',
        'Authorization': `Bearer ${JSON.parse(localStorage.getItem('cyDocsToken'))}`
    }
})
export default url;
