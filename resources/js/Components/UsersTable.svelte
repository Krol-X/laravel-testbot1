<script>
  import { Table } from '@sveltestrap/sveltestrap';

  export let users = [];
</script>

<Table bordered responsive>
  <thead>
  <tr>
    <th>ID</th>
    <th>Дата создания</th>
  </tr>
  </thead>
  <tbody>
  {#each users as user}
    <tr>
      <td>{user['id']}</td>
      <td>{new Date(user['created_at']).toLocaleString()}</td>
    </tr>
  {/each}
  </tbody>
</Table>
