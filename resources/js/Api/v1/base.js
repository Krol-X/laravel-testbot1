import {api} from '@/config.json';

const base_url = api.v1.url;

export const api_v1_method = (type, url) => {
  const request_url = `${base_url}/${url}`.replace('//', '/');
  return async (url_params = undefined, params = undefined, config = undefined) => {
    const url = url_params? `${request_url}/${url_params}`: request_url
    const response = await axios[type](url, params, config);
    return response.data;
  }
}
