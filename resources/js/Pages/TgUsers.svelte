<script>
  import {onMount} from "svelte";
  import {Button} from "@sveltestrap/sveltestrap";
  import UsersTable from "@/Components/UsersTable.svelte";
  import {api_v1} from '@/Api/v1'

  let users = []

  async function loadUsers() {
    try {
      const response = await api_v1.tg_user.list();
      if (response?.ok) {
        users = response?.data ?? [];
      }
    } catch (err) {
      console.log(`Loading error: ${err}`);
    }
  }

  onMount(async () => {
    await loadUsers();
  });
</script>

<Button
  on:click={loadUsers}
  color="secondary"
  outline={true}
  children="Refresh"/>

<UsersTable {users} />
