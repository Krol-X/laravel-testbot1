<script>
  export let user_data
  export let edit_store
  export let key
  export let is_edited

  $: value = user_data? user_data[key]: ''
  $: edit_value = $edit_store? $edit_store[key]: ''

  function onInput(e) {
    edit_store.update(it => ({...it, [key]: e.target.value}))
  }
</script>

<td>
  {#if is_edited}
    <input class="editable" type="text" on:input={onInput} value={edit_value} />
  {:else}
    <div class="editable">{value}</div>
  {/if}
</td>

<style>
  .editable {
    display: block;
    text-align: left;
    background: none;
    border: thin solid transparent;
    padding: 0;
    width: 100%;
    height: 100%;
    font-size: 1rem;
    color: #000;
  }
  td:has(input.editable) {
    background: #f8f8f8;
  }
</style>
