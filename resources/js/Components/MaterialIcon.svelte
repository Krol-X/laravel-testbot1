<script>
  import {formatToHTMLStyleFromObject} from "@/utils/styles.js";

  export let type = ''

  export {_class as class};
  let _class = '';

  export let style = {};
  $: styleHTML = formatToHTMLStyleFromObject(style);
</script>

{#if type==='play'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M3 1V19.6667L17.6667 10.3333L3 1ZM5.66667 5.85733L12.7
				  10.3333L5.66667 14.8093V5.85733Z" fill="currentColor"/>
  </svg>
{/if}
{#if type==='pause'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M2 1V19H7.14286V1H2ZM12.2857 1V19H17.4286V1H12.2857Z"
          fill="currentColor"/>
  </svg>
{/if}
{#if type==='skip-to-start'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 4V16H3V10.3535L11 16V10.3535L19 16V4L11 9.64648V4L3 9.64648V4H1ZM9
					7.85938V12.1406L5.96875 10L9 7.85938ZM17 7.85938V12.1406L13.9688 10L17
					7.85938Z" fill="currentColor" />
  </svg>
{/if}
{#if type==='end'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 4V16L9 10.3535V16L17 10.3535V16H19V4H17V9.64648L9 4V9.64648L1 4ZM3
          7.85938L6.03125 10L3 12.1406V7.85938ZM11 7.85938L14.0312 10L11
          12.1406V7.85938Z" fill="currentColor" />
  </svg>
{/if}
{#if type==='edit'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.6026 1C15.3602 1 15.1175 1.09234 14.9328 1.27755L13.3156 2.89471L17.105
          6.68413L18.7222 5.06696C19.0926 4.69655 19.0926 4.09681 18.7222 3.72734L16.2724
          1.27755C16.0872 1.09234 15.845 1 15.6026 1ZM11.8946 4.31574L1
          15.2103V18.9997H4.78942L15.684 8.10516L11.8946 4.31574Z" fill="currentColor" />
  </svg>
{/if}
{#if type==='remove'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.4 1L7.5 1.9H3V3.7H17.4V1.9H12.9L12 1H8.4ZM3.9 5.5V17.2C3.9 18.19 4.71 19 5.7
          19H14.7C15.69 19 16.5 18.19 16.5 17.2V5.5H3.9ZM7.86914 8.2L10.2 10.5309L12.5309 8.2L13.8
          9.46914L11.4691 11.8L13.8 14.1309L12.5309 15.4L10.2 13.0691L7.86914 15.4L6.6
          14.1309L8.93086 11.8L6.6 9.46914L7.86914 8.2Z" fill="currentColor" />
  </svg>
{/if}
{#if type==='no-register'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M12 1H4.8C3.81 1 3 1.81 3 2.8V17.2C3 18.19 3.81 19 4.8 19H15.6C16.59 19 17.4 18.19
          17.4 17.2V6.4L12 1ZM11.1 7.3V2.35L16.05 7.3H11.1ZM11.4726 13.15L13.3113 14.9887L12.0387
          16.2613L10.2 14.4226L8.3613 16.2613L7.0887 14.9887L8.9274 13.15L7.0887 11.3113L8.3613
          10.0387L10.2 11.8774L12.0387 10.0387L13.3113 11.3113L11.4726 13.15Z" fill="currentColor" />
  </svg>
{/if}
{#if type==='save'}
  <svg class={_class} style={styleHTML} viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 1H3C1.89 1 1 1.9 1 3V17C1 18.1 1.89 19 3 19H17C18.1 19 19 18.1 19 17V5L15 1ZM10
          17C8.34 17 7 15.66 7 14C7 12.34 8.34 11 10 11C11.66 11 13 12.34 13 14C13 15.66 11.66
          17 10 17ZM13 7H3V3H13V7Z" fill="currentColor"/>
  </svg>
{/if}
