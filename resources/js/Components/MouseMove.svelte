<script context="module">
  import {writable} from 'svelte/store'
  export const last_event = writable({});
  const handlers = writable({})

  export function add_handler(handler) {
    handlers.update(it => ({...it, [handler]: handler}))
  }
  export function remove_handler(handler) {
    handlers.update(it => {
      if (it[handler])
        delete it[handler]
      return it
    })
  }
</script>

<svelte:document on:mousemove={(e) => {
  last_event.set(e)
  for (const fn of Object.values($handlers)) {
    fn(e)
  }
}} />
