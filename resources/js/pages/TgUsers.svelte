<script>
  import {onMount} from "svelte";
  import {Button} from "@sveltestrap/sveltestrap";
  import {createUsersStore} from "@/stores/users_store.js";
  import UsersTable from "@/components/UsersTable.svelte";

  let is_loading = false;
  const users_store = createUsersStore()

  async function loadUsers() {
    is_loading = true;
    try {
      await users_store.loadItems()
    } catch (err) {
      console.log(`Loading error: ${err}`);
    }
    is_loading = false;
  }

  onMount(async () => {
    await loadUsers();
  });
</script>

<Button
  class="mb-3"
  on:click={loadUsers}
  color="secondary"
  outline={true}
  children="Обновить"
/>

<div>
  {#if is_loading}
    Загрузка...
  {:else}
    <UsersTable {users_store} />
  {/if}
</div>

