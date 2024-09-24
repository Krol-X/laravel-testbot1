<script>
  import {api_v1} from "@/api/v1";
  import MaterialIcon from "@/components/MaterialIcon.svelte";
  import {Button} from "@sveltestrap/sveltestrap";

  export let user_data = {}
  export let users // store
  export let edited // store -- fixit

  $: is_edited = $edited?.id === user_data.id

  function onRemoveClick(e) {
    users.removeItem(user_data.id)
  }

  function onEditClick(e) {
    edited.set(Object.assign({}, user_data))
  }

  function onUndoClick(e) {
    edited.set(null)
  }

  function onSaveClick(e) {
    edited.update(new_value => {
      users.updateItem(new_value)
      return null
    })
  }
</script>

<tr>
  <td>{user_data['id']}</td>
  <td>{user_data['firstname']}</td>
  <td>{user_data['lastname']}</td>
  <td>{user_data['username']}</td>
  <td>{new Date(user_data['created_at']).toLocaleString()}</td>
  <td class="actions">
    <div class='actions-buttons'>
      <Button
        class="actions-button"
        color="none"
      >
        <MaterialIcon type="edit" />
      </Button>
      <Button
        class="actions-button"
        color="none"
        on:click={onRemoveClick}
      >
        <MaterialIcon type="remove" />
      </Button>
    </div>
  </td>
</tr>

{#if $edited !== null}
  {#if is_edited}
    <button on:click={onUndoClick}>Undo</button>
    <button on:click={onSaveClick}>Save</button>
  {/if}
{:else}
  <button on:click={onEditClick}>Edit</button>
  <button on:click={onRemoveClick}>Remove</button>
{/if}

<style>
  td {
    max-width: 100px;
    word-break: break-all;
    cursor: pointer;
    padding: 0.25rem;
  }
  td:last-child {
    cursor: default;
  }
  .actions-buttons {
    display: flex;
    gap: 0.125rem;
  }
  :global(.actions-button) {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    width: 26px; height: 26px;
  }
  :global(.actions-button:hover) {
    border: thin solid black;
  }
  :global(.actions-button svg) {
    width: auto; height: 80%;
  }
</style>
