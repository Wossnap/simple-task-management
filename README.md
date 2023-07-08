## How to run the project

- run composer install
- run npm install
- run npm run build
- update the .env file to reflect your db details
- run php artisan migrate --seed
- run php artisan key:gen
- run php artisan serve

### For testing

- update the .env.testing to reflect your testing db
- run php artisan migrate --env testing
- run php artisan test
