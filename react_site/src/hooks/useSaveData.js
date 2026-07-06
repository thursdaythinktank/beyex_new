/**
 * useSaveData — true when the user has opted into Data Saver mode.
 * Reads navigator.connection?.saveData once. SSR/undefined-safe.
 */
export function useSaveData() {
  if (typeof navigator === 'undefined') return false;
  return navigator.connection?.saveData === true;
}
