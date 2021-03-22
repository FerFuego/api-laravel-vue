# api-laravel-vue
<p>Proyecto API laravel + vue2.js</p>
<p>Laravel v8.33.1 (PHP v7.4.8)</p>
<p>API with Laravel Passport</p>


## INSTALLATION

- 0 clone this repo in your local
- 1 run:> composer install
- 2 run:> npm install
- 3 create db and config .env
- 4 run:> php artisan storage:link
- 5 run:> php artisan migrate --seed
- 6 run:> php artisan passport:install
- 7 run:> php artisan key:generate
- 8 run:> php artisan serve
- 9 run:> npm run dev


## API REST

<p>Recursos</p>
- POST api/login Para hacer el login y obtener su token de acceso;
- POST api/register Para crear un nuevo usuario en la aplicación;

<p>PRODUCTOS</p>

- GET api/products
- GET api/products/{date}

<p>CATEGORIAS</p>

- GET api/categories
- GET api/categories/{id}