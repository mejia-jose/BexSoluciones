import axios from 'axios';

const apiClient = axios.create(
{
  baseURL: window.appConfig.baseUrl + '/api',
  withCredentials: false,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
});

export default {
  getAllVisits() {
    return apiClient.get('/all-visits');
  }
}
