const mix = require("laravel-mix")
const StyleLintPlugin = require("stylelint-webpack-plugin")

const DEV_DOMAIN = "projectName.test"
const THEME_DIRECTORY = "projectName"

mix
  .js("js/app.js", "dist/js")
  .sass("sass/app.scss", "dist/css")
  .sourceMaps(mix.inProduction(), "source-map")
  .options({ processCssUrls: false })
  .browserSync({
    proxy: DEV_DOMAIN,
    files: ["dist/**/*", "**/*.php"]
  })
  .webpackConfig({
    module: {
      rules: [
        {
          test: /.(vue|jsx|js)$/,
          loader: "eslint-loader",
          enforce: "pre",
          exclude: /node_modules/,
          options: {
            cache: true,
            configFile: ".eslintrc"
          }
        }
      ]
    },
    output: {
      publicPath: `/wp-content/themes/${THEME_DIRECTORY}/`,
      chunkFilename: "dist/js/[name].[chunkhash].js"
    },
    plugins: [
      new StyleLintPlugin({ lintDirtyModulesOnly: !mix.inProduction() })
    ],
    externals: {
      jquery: "jQuery"
    }
  })
