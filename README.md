## LaraNuxt base by Filip Cieslik
This is a basic repository for the purpose of myself doing projects with Laravel 7 and Vue with Nuxt.js framework.

The repo will have a couple of composer and package files to sort out useful (most likely used by me) features that I would have to do any time I would start a new project.

I do not require this to be perfect for everyone, if you want to contribute, do it.

This readme file will cover what exactly comes in a package.

If you wish to use redis, use Laravel Horizon too.

## Laravel

If you use SPA, all your blade files should include resources/js/app.js in the body.

If you don't do SPA, you will have to create a js file for every other page as usual.

For some cases, there will be jQuery with Bootstrap available.

EXPLICITLY SET ENV in nuxt.config.js

- `php artisan migrate`
- `npm install`
- `php artisan passport:install` (with --uuids if you want them)
- `php artisan optimize:full`

## Composer packages included
composer require spatie/laravel-translatable - translate options of a model to be different names
https://github.com/spatie/laravel-translatable

composer require spatie/laravel-image-optimizer - optimizing images to make them easier to transmit.
config/image-optimizer file is already published.
https://github.com/spatie/laravel-image-optimizer

composer require spatie/laravel-csp
content security policy for no malicious js injection.
config/csp.php holds info
https://github.com/spatie/laravel-csp

composer require spatie/laravel-db-snapshots
db snapshots - dump and load
app/config/filesystems.php gets a new disk called snapshots for this.
config/db-snapshots holds the defaults for snapshotting.
https://github.com/spatie/laravel-db-snapshots

composer require spatie/eloquent-sortable
sortable trait for eloquent models
useful for sorting
https://github.com/spatie/eloquent-sortable

if not using nuxt or some front-end SSR, download this
https://github.com/spatie/laravel-server-side-rendering

composer require spatie/laravel-missing-page-redirector
https://github.com/spatie/laravel-missing-page-redirector
used for retaining SEO when moving to new site setup (changing addresses and redirecting)
/config/missing-page/redirector.php holds data.

composer require spatie/laravel-failed-job-monitor
failed job notification interface. works with slack(requires guzzle too) and mail out of the box.
config/failed-job-monitor.php holds default data.

composer require spatie/laravel-permission
https://github.com/spatie/laravel-permission
basic permissions and roles. utilizes Laravel Gate(https://laravel.com/docs/7.x/authorization#gates)

composer require spatie/laravel-medialibrary
https://github.com/spatie/laravel-medialibrary
handles filesystems and uploads.

composer require spatie/laravel-backup
https://github.com/spatie/laravel-backup
backup of the application
php artisan backup:run does the job.
db snapshot is just for db, this backs up application too.


composer require spatie/laravel-activitylog
https://github.com/spatie/laravel-activitylog
config/activitylog.php is default file holder.
needs migrating (migration is there already)

composer require spatie/laravel-sitemap
sitemap generator (SEO)
https://github.com/spatie/laravel-sitemap
config/sitemap.php

composer require spatie/laravel-cookie-consent
basic blade file for cookie consent issue and handling. either include it as a blade template or with middleware
        \Spatie\CookieConsent\CookieConsentMiddleware::class,
middleware set by default.
https://github.com/spatie/laravel-cookie-consent
config/cookie-consent.php holds config
resources/lang/vendor/cookieconsent for just the text customization
resources/views/vendor/cookieconsent for full customization

composer require spatie/laravel-web-tinker --dev
tinker for web
used only in dev
creates a route to use tinker interactively over a website.
config/web-tinker.php holds default config
YOU CAN SETUP AUTHORIZATION WITH A GATE:
You must register a viewWebTinker ability. A good place to do this is in the AuthServiceProvider that ships with Laravel.
public function boot()
{
    $this->registerPolicies();

    Gate::define('viewWebTinker', function ($user = null) {
        // return true if access to web tinker is allowed
    });
}
You must set the enabled variable in the web-tinker config file to true.

composer require spatie/laravel-link-checker
crawler to test all endpoints to see if they return 200.
config/laravel-link-checker.php with defaults
can set up own check profiles etc.


composer require spatie/laravel-blade-javascript
passing data from blade to js
https://github.com/spatie/laravel-blade-javascript
config/blade-javascript.php holds config
resources/views/vendor/bladeJavaScript holds the script template.
pass it as @javascript('key', 'value')


composer require spatie/laravel-robots-middleware
enabling and disabling SEO indexing - created a default middleware and assigned it in kernel

composer require spatie/laravel-validation-rules
basic validation rules.
https://github.com/spatie/laravel-validation-rules
resources/lang/vendor/validationRules - edit for translations.


composer require spatie/laravel-blink
a single request cache data holder.
If you have an expensive function somewhere, call it with blink to keep the outcome for future reference (before end of request)
added alias and provider

composer require laravel/passport
for better authentication after you get rid of SPA bit in nuxt.
/resources/js/components/passport for basic passport use (VUE only)

composer require spatie/crawler
a good crawler for getting data off other pages.

npm install puppeteer
composer require spatie/browsershot
server-side screenshots.

composer require maatwebsite/excel
handling excel spreadsheets.
https://docs.laravel-excel.com/3.1/getting-started/installation.html
config/excel.php

composer require barryvdh/laravel-debugbar --dev
debugbar for debugging
https://packalyst.com/packages/package/barryvdh/laravel-debugbar

composer require fruitcake/laravel-cors
cors header sendding with middleware.

this project was based on laravel nuxt repo as a starter template, then added libraries of preference.
## Features

- Nuxt 2.11
- Laravel 7
- SPA or SSR
- Socialite integration
- VueI18n + ESlint + Bootstrap 4 + Font Awesome 5
- Login, register, email verification and password reset as base (main page serves SPA, api file serve functionality)


## Usage

### Development

```bash
npm run dev
```

You can access your application at `http://localhost:3000`.

### Production

```bash
npm run build
```

You can access your application the url you set `APP_URL` to.

### Enable SSR

- Remove `mode: 'spa'` and `'~plugins/nuxt-client-init'` from `client/nuxt.config.js`
- Edit `.env` to set `APP_URL=http://api.example.com` and `CLIENT_URL=http://example.com`
- Run `npm run build` and `npm run start`

#### Nginx Proxy

For Nginx you can add a proxy using the follwing location block:

```
server {
    location / {
        proxy_pass http://http://127.0.0.1:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

#### Process Manager

In production you need a process manager to keep the Node server alive forever:

```bash
# install pm2 process manager
npm install -g pm2

# startup script
pm2 startup

# start process
pm2 start npm --name "laravel-nuxt" -- run start

# save process list
pm2 save

# list all processes
pm2 l
```

After each deploy you'll need to restart the process:

```bash
pm2 restart laravel-nuxt
```

Make sure to read the [Nuxt docs](https://nuxtjs.org/).

## Socialite

This project comes with GitHub as an example for [Laravel Socialite](https://laravel.com/docs/5.8/socialite).

To enable the provider create a new GitHub application and use `https://example.com/api/oauth/github/callback` as the Authorization callback URL.

Edit `.env` and set `GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET` with the keys form your GitHub application.

For other providers you may need to set the appropriate keys in `config/services.php` and redirect url in `OAuthController.php`.

## Email Verification

To enable email verification make sure that your `App\User` model implements the `Illuminate\Contracts\Auth\MustVerifyEmail` contract.

## Notes

- This project uses [router-module](https://github.com/nuxt-community/router-module), so you have to add the routes manually in `client/router.js`.
- If you want to separate this in two projects (client and server api), move `package.json` into `client/` and remove config path option from the scripts section. Also make sure to add the env variables in `client/.env`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
