<script context="module">
  import {last_event, add_handler, remove_handler} from "@/components/MouseMove.svelte";
</script>

<script>
  export let store
  export let px = 0
  export let py = 24

  let tooltip = null
  let is_visible = false

  function updateTooltip(e) {
    if (tooltip) {
      const x = e.clientX + px
      const y = e.clientY + py

      tooltip.style['left'] = `${x}px`
      tooltip.style['top'] = `${y}px`
    }
  }

  store.subscribe(it => {
    if (it) {
      is_visible = true
      updateTooltip($last_event)
      add_handler(updateTooltip)
    } else {
      remove_handler(updateTooltip)
      is_visible = false
    }
  })
</script>

{#if is_visible}
  <div id="mouse-tooltip" bind:this={tooltip}>
    {$store}
  </div>
{/if}

<style>
  #mouse-tooltip {
    display: inline-block;
    position: absolute;
    color: #000;
    background: rgba(255, 255, 255, .05);
    border-radius: 4px;
    padding: 0.1rem;
  }
</style>
