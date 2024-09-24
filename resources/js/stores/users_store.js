import { writable } from 'svelte/store';
import {api_v1} from "@/api/v1";

export function createUsersStore() {
  const { subscribe, set, update } = writable([]);

  return {
    subscribe,
    set,
    update,
    loadItems: async () => {
      const response = await api_v1.tg_user.read()
      set(response?.data ?? [])
    },
    removeItem: async (id) => {
      await api_v1.tg_user.delete(id)
      update(_ => _.filter(it => it.id != id))
    },
    updateItem: async (values) => {
      const id = values.id
      await api_v1.tg_user.update(id, values)
      update(_ => {
        const idx = _.findIndex((it) => it.id == id)
        _[idx] = Object.assign({}, values)
        return _
      })
    }
  };
}
