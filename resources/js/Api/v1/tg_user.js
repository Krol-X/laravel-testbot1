import {api_v1_method} from './base.js'

export default {
  create: api_v1_method('post', 'tg-users'),
  read: api_v1_method('get', 'tg-users'),
  update: api_v1_method('put', 'tg-users'),
  delete: api_v1_method('delete', 'tg-users')
}
