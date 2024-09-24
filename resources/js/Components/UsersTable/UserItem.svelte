<script>
  import MaterialIcon from "@/components/MaterialIcon.svelte";
  import {Button} from "@sveltestrap/sveltestrap";
  import EditableCell from "@/components/UsersTable/EditableCell.svelte";

  export let users_store
  export let edit_store
  export let user_data = {}

  $: is_edited = $edit_store?.id === user_data.id

  function onRemoveClick(e) {
    users_store.removeItem(user_data.id)
  }

  function onEditClick(e) {
    edit_store.set(Object.assign({}, user_data))
  }

  function onUndoClick(e) {
    edit_store.set(null)
  }

  function onSaveClick(e) {
    edit_store.update(new_value => {
      users_store.updateItem(new_value)
      return null
    })
  }
</script>

<tr class:is-edited={is_edited} data-id={user_data['id']}>
  <td>{user_data['id']}</td>
  <EditableCell {user_data} {is_edited} {edit_store} key="firstname" />
  <EditableCell {user_data} {is_edited} {edit_store} key="lastname" />
  <EditableCell {user_data} {is_edited} {edit_store} key="username" />
  <td>{new Date(user_data['created_at']).toLocaleString()}</td>
  <td class="actions">
    <div class='actions-buttons'>
      {#if $edit_store !== null}
        {#if is_edited}
          <Button class="actions-button" color="none" on:click={onUndoClick}>
            <MaterialIcon type="no-register" />
          </Button>
          <Button class="actions-button" color="none" on:click={onSaveClick}>
            <MaterialIcon type="save" />
          </Button>
        {/if}
      {:else}
        <Button class="actions-button"color="none" on:click={onEditClick}>
          <MaterialIcon type="edit" />
        </Button>
        <Button class="actions-button" color="none" on:click={onRemoveClick}>
          <MaterialIcon type="remove" />
        </Button>
      {/if}
    </div>
  </td>
</tr>

<style>
  :global(td) {
    width: fit-content;
    max-width: 80px;
    cursor: pointer;
    /*word-break: break-all;*/
  }
  :global(tr:last-child) {
    cursor: auto;
  }
  :global(tr.is-edited td) {
    cursor: auto;
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
