import {api} from '@/config.json';

const base_url = api.v1.url;

export const api_v1_method = (type, url) => {
  const request_url = `${base_url}/${url}`.replace('//', '/');
  return async (params = undefined, config = undefined) => {
    const response = await axios[type](request_url, params, config);
    return response.data;
  }
}
