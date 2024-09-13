<script context="module">
  import {layout, title} from '../Layouts/Layout.svelte'
</script>
<script>
  $layout = 'another'
  $title = 'test'

  export let user = '';

  import {Button, Col, Row} from '@sveltestrap/sveltestrap';
</script>


<Row>
  <Col>
    <h1>Hello#2 {user}!</h1>
  </Col>
  <Col>
    <Button color="primary" outline>Hello World!</Button>
  </Col>
</Row>
