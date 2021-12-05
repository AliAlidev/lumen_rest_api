1- create lumen project composer create-project --prefer-dist laravel/lumen project-name
2- add artisan package to the project because it isn't installed with lumen composer require flipbox/lumen-generator
3- register it on app.php inside bootstrap in  Register Service Providers
4- add database keys to .env file
5- generate application key
6- generate model factory controller migration with one command php artisan make:model Blog -mfc
7- add columns to migration file title and body for blog model
8- migrate database
9- insert dummy data to bost model inside factory file
10- add hasFactory triat to Blog model
11- create new records with tinker (you should write full bath to model file)
12- create route to git all posts
13- to allow elequent we should uncomment row $app->withEloquent(); inside app.php inside bootstrap folder
14- query inside route file should be with this format $router->get('posts', 'BlogController@index')
15- add crud controllers get, post, put, delete
16- when using put methode note that when passing variables with postman you should pass it from 
    body->row->json  type
17- add user table and add auth controller




