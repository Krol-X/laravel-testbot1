<script>
  import { Table } from '@sveltestrap/sveltestrap';

  export let users = [];
  export let is_loading = false;
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
      </tr>
      </thead>
      <tbody>
      {#each users as user}
        <tr>
          <td>{user['id']}</td>
          <td>{user['firstname']}</td>
          <td>{user['lastname']}</td>
          <td>{user['username']}</td>
          <td>{new Date(user['created_at']).toLocaleString()}</td>
        </tr>
      {/each}
      </tbody>
    </Table>
  {/if}
</div>
