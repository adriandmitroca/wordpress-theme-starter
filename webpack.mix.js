const mix = require("laravel-mix")
const StyleLintPlugin = require("stylelint-webpack-plugin")
const ESLintPlugin = require("eslint-webpack-plugin")

require("laravel-mix-polyfill")

const DEV_DOMAIN = "projectName.test"
const THEME_DIRECTORY = "projectName"

mix
  .js("js/app.js", "dist/js")
  .sass("sass/app.scss", "dist/css")
  .sourceMaps(false, "source-map")
  .options({ processCssUrls: false })
  .browserSync({
    proxy: DEV_DOMAIN,
    files: ["dist/**/*", "**/*.php"],
  })
  .polyfill({
    enabled: true,
    useBuiltIns: "usage",
    targets: "> 0.25%, not dead, ie 11",
  })
  .webpackConfig({
    output: {
      publicPath: `/wp-content/themes/${THEME_DIRECTORY}/`,
      chunkFilename: "dist/js/[name].[chunkhash].js",
    },
    plugins: [
      new ESLintPlugin({
        extensions: ["js", "vue"],
      }),
      new StyleLintPlugin({ lintDirtyModulesOnly: !mix.inProduction() }),
    ],
    externals: {
      jquery: "jQuery",
    },
  })
