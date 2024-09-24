<script>
  import {
    Collapse,
    NavbarToggler,
    NavbarBrand,
    Nav,
    Navbar,
    NavItem,
    NavLink,
  } from '@sveltestrap/sveltestrap';

  import {inertia} from '@inertiajs/svelte'

  let isOpen = false;

  function handleUpdate(event) {
    isOpen = event.detail.isOpen;
  }
</script>

<Navbar color="dark" light expand="md" container="md">
  <NavbarBrand><a href="/" use:inertia>Bot1 admin panel</a></NavbarBrand>
  <NavbarToggler on:click={() => (isOpen = !isOpen)} />
  <Collapse {isOpen} navbar expand="md" on:update={handleUpdate}>
    <Nav class="ms-auto" navbar>
      <NavItem>
        <NavLink><a href="/tg-users" use:inertia>Telegram users</a></NavLink>
      </NavItem>
    </Nav>
  </Collapse>
</Navbar>

<style>
  a {
    color: white;
    text-decoration: none;
  }
  a:hover {
    color: lightgreen;
  }
</style>
