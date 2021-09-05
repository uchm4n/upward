## Upward: a crud demo application. 
#### Packages Used: 
Laravel Passport, Laravel UI, Vue.JS, Bootstrap, VeeValidate

## Instalation

- create sqlite file in `database/database.sqlite`

- in `.env` file change following variables or delete commented variables:
DB_CONNECTION=sqlite
#DB_HOST=
#DB_PORT=
#DB_DATABASE=
#DB_USERNAME=

- run `php artisan migrate` 
- to populate sqlite file with dummy records go to `php artisan tinker` and run:
  `$products = \App\Models\Product::factory()->count(50)->create();`


