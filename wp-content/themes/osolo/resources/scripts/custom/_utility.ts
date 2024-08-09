/**
 * Dynamically imports ts file from path if selector returns elements
 * @param {string} selector - Rendered elements to trigger the code
 * @param {string} path - Path to the file where the default function will be executed
 */
export async function dynamicImport(
  selector: string,
  path: string,
): Promise<void> {
  if ($(selector).length > 0) {
    const mod = await import(path + '.ts');
    mod.default();
  }
}
