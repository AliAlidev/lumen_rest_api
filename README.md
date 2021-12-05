1- create lumen project composer create-project --prefer-dist laravel/lumen project-name
2- add artisan package to the project because it isn't installed with lumen composer require flipbox/lumen-generator
3- register it on app.php inside bootstrap in  Register Service Providers
4- add database keys to .env file
5- generate application key
6- generate model factory controller migration with one command php artisan make:model Blog -mfc
7- add columns to migration file title and body for blog model
8- migrate database
9- insert dummy data to bost model inside factory file

