import js from '@eslint/js';
import globals from 'globals';
import tseslint from 'typescript-eslint';

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
      // Varning: kvarvarande any gäller otypade tredjepartsglobaler.
      '@typescript-eslint/no-explicit-any': 'warn',
    },
  },
);
