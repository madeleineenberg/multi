/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */
const path = require('path');
const mix = require('laravel-mix');
const purgecssWordpress = require('purgecss-with-wordpress');
const purgeConfig = require('./purgecss.config');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');
// const ErrorOverlayPlugin = require('error-overlay-webpack-plugin');

let publicPath = path.join(process.cwd(), 'dist/');
publicPath = '/' + publicPath.slice(publicPath.indexOf('web/') + 4);

// require('dotenv').config({ path: '../../../../.env' });
require('dotenv').config({ path: '../../../.env' });
require('laravel-mix-purgecss');
require('laravel-mix-copy-watched');
require('laravel-mix-compress');

const aliases = {
  '@styles': path.join(__dirname, 'resources/styles'),
  '@images': path.join(__dirname, 'resources/images'),
  '@scripts': path.join(__dirname, 'resources/scripts'),
  '@fonts': path.join(__dirname, 'resources/fonts'),
};

mix.setPublicPath('./dist').browserSync({
  proxy: { target: process.env.WP_HOME },
});

mix
  .sass('resources/styles/main.scss', 'styles')
  .sass('resources/styles/editor.scss', 'styles')
  .options({ processCssUrls: false })
  .purgeCss({
    extend: { content: [path.join(__dirname, 'index.php')] },
    safelist: {
      standard: [...purgecssWordpress.safelist, ...purgeConfig.standard],
      deep: [...purgeConfig.deep],
    },
  })
  .alias(aliases)
  .compress();

mix
  .ts('resources/scripts/app.ts', 'scripts')
  .ts('resources/scripts/customizer.ts', 'scripts')
  .ts('resources/scripts/editor.ts', 'scripts')
  .extract()
  .alias(aliases)
  .webpackConfig({
    plugins: [
      new DependencyExtractionWebpackPlugin(),
      // new ErrorOverlayPlugin(),
    ],
    output: {
      publicPath,
    },
  })
  .compress();

mix
  .copyWatched('resources/images/**', 'dist/images')
  .copyWatched('resources/fonts/**', 'dist/fonts');

mix
  .autoload({ jquery: ['$', 'window.jQuery'] })
  .options({ processCssUrls: false })
  .sourceMaps(false, 'cheap-module-source-map')
  .version();
