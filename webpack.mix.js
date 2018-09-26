const mix = require('laravel-mix');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const webpack = require('webpack');

mix.js('js/app.js', 'dist/js')
  .sass('sass/app.scss', 'dist/css')
  .sourceMaps()
  .options({ processCssUrls: false })
  .browserSync({
    proxy: 'wp-boilerplate.test',
    files: ['dist/**/*', 'acf-modules/*.php'],
  })
  .webpackConfig({
    module: {
      rules: [
        {
          test: /.(vue|jsx|js)$/,
          loader: 'eslint-loader',
          enforce: 'pre',
          exclude: /node_modules/,
          options: {
            cache: true,
            configFile: '.eslintrc',
          },
        },
      ],
    },
    plugins: [
      new StyleLintPlugin({ lintDirtyModulesOnly: !mix.inProduction() }),
      new webpack.ProvidePlugin({
        Util: 'exports-loader?Util!bootstrap/js/dist/util',
      }),
    ],
    resolve: {
      alias: {
        jquery: 'jquery/src/jquery',
      },
    },
  });
