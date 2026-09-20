import js from '@eslint/js';
import globals from 'globals';
import tseslint from 'typescript-eslint';

// Flat config. ESLint 9 läser inte längre .eslintrc.js.
// Filändelsen är .mjs eftersom paketet saknar "type": "module".
export default tseslint.config(
  {
    ignores: ['dist/**', 'node_modules/**', 'vendor/**', 'storage/**'],
  },
  js.configs.recommended,
  ...tseslint.configs.recommended,
  {
    files: ['resources/scripts/**/*.ts'],
    languageOptions: {
      globals: {
        ...globals.browser,
        ...globals.jquery,
        wp: 'readonly',
      },
    },
    rules: {
      // Varning, inte fel. Samtliga kvarvarande any pekar på otypade
      // globaler vi inte äger – window.acf, window.locomotiveScroll,
      // locomotives scroll-event och webkitBackdropFilter. Att typa dem
      // hör hemma i typings.d.ts, inte i en lint-körning som ska kunna
      // passera. Rulen står kvar så att nya any syns.
      '@typescript-eslint/no-explicit-any': 'warn',
    },
  },
);
