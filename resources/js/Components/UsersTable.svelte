<script context="module">
  import {mouse_tooltip} from '@/Layouts/Layout.svelte'
</script>

<script>
  import {Button, Table} from '@sveltestrap/sveltestrap';
  import MaterialIcon from "@/Components/MaterialIcon.svelte";

  export let users = [];
  export let is_loading = false;

  function onTBodyClick(e) {
    if (e.target.tagName === 'TD' && e.target.className !== 'actions') {
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
        <tr>
          <td>{user['id']}</td>
          <td>{user['firstname']}</td>
          <td>{user['lastname']}</td>
          <td>{user['username']}</td>
          <td>{new Date(user['created_at']).toLocaleString()}</td>
          <td class="actions" data-id={user['id']}>
            <Button
              class="actions-button"
              color="none"
            >
              <MaterialIcon type="edit" />
            </Button>
            <Button
              class="actions-button"
              color="none"
            >
              <MaterialIcon type="remove" />
            </Button>
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
  }
  tbody.editable td {
    cursor: text;
  }
  :global(.actions-button) {
    width: 32px; height: 32px;
    padding: 0.1rem;
  }
</style>
