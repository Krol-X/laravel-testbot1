<script context="module">
  import {writable} from 'svelte/store'
  import {createFadedStore} from '@/utils/faded_store.js'

  export const layout = writable('');
  export const title = writable('');

  export const mouse_tooltip = createFadedStore()
</script>

<script>
  import DefaultLayout from './Default.svelte'
  import MouseTooltip from "@/Components/MouseTooltip.svelte";
  import MouseMove from "@/Components/MouseMove.svelte";

  $: layout_component = (() => {
    switch ($layout) {
      default:
        console.log('DefaultLayout')
        return DefaultLayout
    }
  })();
</script>

<svelte:head>
  <title>{$title}</title>
</svelte:head>

<svelte:component this={layout_component} title={$title}>
  <slot/>
</svelte:component>

<MouseMove />
<MouseTooltip store={mouse_tooltip} />
