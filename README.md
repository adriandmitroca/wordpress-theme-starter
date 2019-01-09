# WordPress Theme Starter

WordPress starter theme with a modern development workflow without any PHP dependencies required and simple deployment.

## Features

* Flat and simple to understand theme file structure following best WordPress' standards.
* [Laravel Mix](https://laravel.com/docs/5.7/mix) with full support SASS, ES6, autoprefixing and [Browsersync](http://www.browsersync.io/).
* [Simple templating engine](https://github.com/adriandmitroca/wordpress-theme-boilerplate/blob/master/templates/content-single.php) that wraps your template with header, footer and base structure automatically.
* [Custom module approach](https://github.com/adriandmitroca/wordpress-theme-boilerplate/blob/master/acf-modules/example.php) that allows you to quickly build entire site on separated components based on [ACF's Flexible Content](https://www.advancedcustomfields.com/resources/flexible-content/) with full nesting, reusing and previewing support.
* [Bootstrap 4](https://getbootstrap.com/) with full [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) support and some framework-friendly filters.
* [stylelint](https://stylelint.io/) with [stylelint-prettier](https://github.com/prettier/stylelint-prettier) and [stylelint-config-recess-order](https://github.com/stormwarning/stylelint-config-recess-order).
* [ESLint](https://eslint.org/) with [eslint-config-airbnb-base](https://www.npmjs.com/package/eslint-config-airbnb-base), [eslint-plugin-vue](https://vuejs.github.io/eslint-plugin-vue/) and [prettier-eslint](https://github.com/prettier/prettier-eslint).
* [Polyfill.io](https://polyfill.io) for dynamic JavaScript polyfills.
* Lots of useful [helpers](https://github.com/adriandmitroca/wordpress-theme-boilerplate/blob/master/src/helpers.php)
* [TGM Plugin Activation](http://tgmpluginactivation.com/) to manage your plugin dependencies across different environments.

## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 5.0
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.3
* [Node.js](http://nodejs.org/) >= 8.0.0
* [Yarn](https://yarnpkg.com/en/docs/install)


## Theme structure

```shell
themes/your-theme-name/         # → Root of your theme
├── acf-json/                   # → Home of your ACF config
├── acf-modules/                # → Home of your ACF modules
├── dist/                       # → Built theme assets (never edit)
├── js/                         # → Theme JS
├── languages/                  # → Theme language files (optional)
├── sass/                       # → Theme stylesheets
├── src/                        # → Theme PHP logic
│   ├── Helpers/                # → Helper source files
│   ├── vendor/                 # → External code fetched from elsewhere (never edit)
│   ├── assets.php              # → Theme assets
│   ├── filters.php             # → Theme filters
│   ├── helpers.php             # → Helper functions
│   ├── navs.php                # → Theme navigations
│   ├── option-pages.php        # → Theme Option Pages
│   ├── plugins.php             # → Theme Plugin Dependencies
│   ├── post-types.php          # → Theme Custom Post Types
│   └── supports.php            # → Theme Basic Supports
├── static/                     # → Theme static assets
│   ├── fonts/                  # → Theme fonts
│   ├── images/                 # → Theme images
│   └── vectors/                # → Theme SVG files
├── templates/                  # → Theme templates
│   ├── partials/               # → Partial templates
│   ├── content-search.php      # → Search template
│   ├── content-single-page.php # → Page template (modular)
│   └── content.php             # → Index (archive) template
├── 404.php                     # → 404 template
├── base.php                    # → Base template
├── footer.php                  # → Footer template
├── functions.php               # → Helpers autoloader, theme includes
├── header.php                  # → Header template
├── index.php                   # → Never manually edit
├── screenshot.png              # → Theme screenshot for WP admin
├── style.css                   # → Theme meta information
└── webpack.mix.js/             # → Laravel Mix config
```


## Theme development

* Run `yarn` from the theme directory to install dependencies.
* Update your local development domain in `webpack.mix.js`.
* Run `yarn watch` to compile assets and run Browsersync.

### Build commands

* `yarn watch` — Compile assets when file changes are made, start Browsersync session
* `yarn dev` — Compile and bundle your assets
* `yarn lint` — Lint your assets
* `yarn prod` — Compile assets for production

## Deployment

Suggested methods of deployment are:
- [rsync](https://rsync.samba.org/) (if SFTP is available in your project)
- [git-ftp](https://git-ftp.github.io/) (if SFTP is not available)

All you need to do is to make sure that bundled assets created by `yarn prod` command lands on your server besides all your regular theme files.

Suggested Continuous Integration software are:
- [CircleCI](https://circleci.com/)
- [Bitbucket Pipelines](https://bitbucket.org/product/features/pipelines)

All examples of deployments are included.
