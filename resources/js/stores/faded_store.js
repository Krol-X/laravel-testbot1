import { writable } from 'svelte/store';

export function createFadedStore(value = '', ms = 1000) {
  let fade_time = ms
  let fade_value = value
  let timeout = null
  const { subscribe, set: _set, update: _update } = writable(value);

  function reset_timer() {
    if (timeout)
      clearTimeout(timeout)
    timeout = setTimeout(() => {
      _set(fade_value);
    }, fade_time);
  }

  return {
    subscribe,
    setDelay: (ms) => fade_time = ms,
    setValue: (value) => fade_value = value,
    set: (value) => {
      _set(value);
      reset_timer();
    },
    update: (f) => {
      _update(f);
      reset_timer();
    }
  };
}
