<script context="module">
  import {mouse_tooltip} from '@/Layouts/Layout.svelte'
</script>

<script>
  import {Table} from '@sveltestrap/sveltestrap';
  import UserItem from "@/components/UsersTable/UserItem.svelte";
  import {writable} from "svelte/store";

  export let users_store

  let edit_store = writable(null)

  function onTBodyClick(e) {
    if (!e.target.closest('td')?.classList.contains('actions')) {
      if ($edit_store && $edit_store.id == e.target.closest('tr').dataset?.id)
        return;
      navigator.clipboard
        .writeText(e.target.innerText)
        .then(() => {
          mouse_tooltip.set('Текст скопирован')
        })
    }
  }

  export let is_editable = false
</script>

<Table bordered responsive style="height: 1px">
  <thead>
  <tr>
    <th>ID</th>
    <th>Имя</th>
    <th>Фамилия</th>
    <th>Тег</th>
    <th>Дата создания</th>
    <th>Действия</th>
  </tr>
  </thead>
  <!-- svelte-ignore a11y-click-events-have-key-events
       a11y-no-noninteractive-element-interactions -->
  <tbody on:click={onTBodyClick} class:editable={is_editable}>
    {#each $users_store as user_data}
      <UserItem {users_store} {edit_store} {user_data} />
    {/each}
  </tbody>
</Table>
