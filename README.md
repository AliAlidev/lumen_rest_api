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
18- install passport package composer require dusterio/lumen-passport
19- incomment line $app->withFacades(); inside app.php in bootstrap folder
20- incomment line 
    $app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    ]);
    inside app.php in bootstrap folder
21- register these services inside Register Service Providers
    $app->register(Laravel\Passport\PassportServiceProvider::class);
    $app->register(Dusterio\LumenPassport\PassportServiceProvider::class);
22- add auth.php inside config folder
23- register this config file from app.php inside bootstrap by change $app->configure('app'); to 
    $app->configure('auth');
24- add this line to Load The Application Routes section
    \Dusterio\LumenPassport\LumenPassport::routes($app, ['prefix' => 'v1/oauth']);
25- add HasApiTokens triat to user model
26- run php artisan migrate
27- run php artisan passport:install (this will create encryption keys and other start for passport)
28- to simplify login proccess we should call oauth api so we need guzzle pacakge by 
    composer require guzzlehttp/guzzle
29- we can put client_secret and client_id in a service by make new service.php file inside config folder
30- register service file in config
31- add register function
32- add logout function






