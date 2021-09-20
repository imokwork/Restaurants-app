# Restaurants-app Nuxt.js + Laravel + Google Map Api
![CHEESE!](Screen%20Shot%20Restaurants-app.gif)
## Nuxt.js Build Setup

```bash
# install dependencies
$ yarn install

$ cp .env.example .env

# Config your BASE_URL and GOOGLE_API_KEY in .env
BASE_URL=
GOOGLE_API_KEY=

# serve with hot reload at localhost:3000
$ yarn dev

# build for production and launch server
$ yarn build
$ yarn start

# generate static project
$ yarn generate
```
For detailed explanation on how things work, check out the [documentation](https://nuxtjs.org).

## Laravel Build Setup (folder name backend)
```bash
$ cd backend

$ composer install

$ cp .env.example .env

# Config your Database in .env
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

$ php artisan migrate

# Generate random data
$ php artisan db:seed

$ php artisan serv
