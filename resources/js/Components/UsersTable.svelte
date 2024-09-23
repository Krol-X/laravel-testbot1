<script context="module">
  import {mouse_tooltip} from '@/Layouts/Layout.svelte'
</script>

<script>
  import {Button, Table} from '@sveltestrap/sveltestrap';
  import MaterialIcon from "@/Components/MaterialIcon.svelte";

  export let users = [];
  export let is_loading = false;

  export let deleteUser

  function onTBodyClick(e) {
    if (e.target.tagName === 'TD' &&
      !e.target.closest('td').classList.contains('actions')
    ) {
      navigator.clipboard
        .writeText(e.target.innerText)
        .then(() => {
          mouse_tooltip.set('Текст скопирован')
        })
    }
  }

  export let is_editable = false
</script>

<div>
  {#if is_loading}
    Loading...
  {:else}
    <Table bordered responsive>
      <thead>
      <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Тэг</th>
        <th>Дата создания</th>
        <th>Действия</th>
      </tr>
      </thead>
      <!-- svelte-ignore a11y-click-events-have-key-events
           a11y-no-noninteractive-element-interactions -->
      <tbody on:click={onTBodyClick} class:editable={is_editable}>
      {#each users as user}
        <tr data-id={user['id']}>
          <td>{user['id']}</td>
          <td>{user['firstname']}</td>
          <td>{user['lastname']}</td>
          <td>{user['username']}</td>
          <td>{new Date(user['created_at']).toLocaleString()}</td>
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
                on:click={(e) => deleteUser(e.target?.closest('tr')?.dataset?.id)}
              >
                <MaterialIcon type="remove" />
              </Button>
            </div>
          </td>
        </tr>
      {/each}
      </tbody>
    </Table>
  {/if}
</div>

<style>
  tbody td {
    max-width: 100px;
    word-break: break-all;
    cursor: pointer;
    padding: 0.25rem;
  }
  tbody td:last-child {
    cursor: default;
  }
  tbody.editable td {
    cursor: text;
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
