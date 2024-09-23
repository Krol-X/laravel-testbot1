<script>
  import {onMount} from "svelte";
  import {Button} from "@sveltestrap/sveltestrap";
  import UsersTable from "@/Components/UsersTable.svelte";
  import {api_v1} from '@/Api/v1'

  let is_loading = false;
  let users = []

  async function loadUsers() {
    is_loading = true;
    try {
      const response = await api_v1.tg_user.read();
      users = response?.data ?? [];
    } catch (err) {
      console.log(`Loading error: ${err}`);
    }
    is_loading = false;
  }

  async function deleteUser(id) {
    if (id) {
      await api_v1.tg_user.delete(id);
      users = users.filter(it => it.id === id)
    }
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

<UsersTable {users} {is_loading} {deleteUser} />
