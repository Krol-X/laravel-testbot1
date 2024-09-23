// https://svelte.dev/repl/a4c53f9b5be64674a5341054490e639b?version=3.16.4

export const formatToHTMLStyleFromObject = (style) => {
  return Object.entries(style).reduce((acc, [key, value]) => `${acc} ${key}: ${value};`, '');
};
