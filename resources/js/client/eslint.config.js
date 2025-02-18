import globals from 'globals';
import pluginJs from '@eslint/js';
import pluginVue from 'eslint-plugin-vue';
import prettierRecommended from 'eslint-plugin-prettier/recommended';
import vueConfigPrettier from '@vue/eslint-config-prettier';

export default [
    // Global language options
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                ...globals.node,
            },
        },
    },
    // Base ESLint recommended rules
    pluginJs.configs.recommended,
    {
        rules: {
            'no-unused-vars': 'off',
            'no-undef': 'off',
        },
    },
    // Vue plugin flat config
    ...pluginVue.configs['flat/recommended'],
    // Vue-specific customizations
    {
        files: ['**/*.vue'],
        rules: {
            ...vueConfigPrettier.rules,
            'vue/multi-word-component-names': 'off',
            'vue/attribute-hyphenation': 'off',
            'vue/no-v-html': 'off',
            'vue/v-on-event-hyphenation': 'off',
        },
    },
    // Custom rules for both .vue and .js files
    {
        files: ['**/*.vue', '**/*.js'],
        rules: {
            'prettier/prettier': [
                'warn',
                {
                    trailingComma: 'es5',
                    singleQuote: true,
                    tabWidth: 4,
                    printWidth: 120,
                },
            ],
            '@typescript-eslint/ban-ts-comment': 'off',
            '@typescript-eslint/no-require-imports': 'off',
            '@typescript-eslint/no-explicit-any': 'off',
        },
    },
    // Ignore certain directories
    {
        ignores: ['node_modules', '.nuxt', '.output', 'dist'],
    },
    // Prettier integration recommended config
    prettierRecommended,
];
