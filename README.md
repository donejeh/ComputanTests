# Laravel assignment

Thanks for your interest in joining Computan. Please work on this assignment that consists of 4 parts.

## Create Authentication for Admins
1. The Admins should be in a separate database table like "admins"
2. The admins should be authenticated by Auth middleware
3. The User must not be able to login in Admin Panel with its credentials present in "users" table
4. The Admin must be able to login with "User Name" and "Email" both

## Import CSV records into Database
1. User must be able to upload and read a CSV file
2. Dump all the records into database
3. The records must not be duplicated
4. CSV columns:
   - ID
   - Name
   - Email
   - Phone
   - Address

## Read data from an API and populate the database
1. Get records from the API https://api.publicapis.org/entries 
2. Save all the records into database
3. The records must not be duplicated in case we send multiple API calls

## Exception handling
1. In case a page doesn't exist, the User must be routed to 404
2. In case of a Fatal Error then it must route to 404 Page
3. In case an exception occur then the Admin must receive an email at tech@computan.com

## Create Jobs 
1. Create a Job that will send Email to all Active Users in database
2. Active User can be retrieved by is_active column in users Table
3. Allow 3 Exceptions and then the job must fail

### Notes

1. Create unit tests: https://phpunit.de/ 
2. Follow Laravel's standards: https://laravel.com/docs/9.x/contributions#coding-style, https://www.php-fig.org/psr/psr-1/ and https://www.php-fig.org/psr/psr-2/
3. Provide deployment info to get your code running and all assets needed like SQL dump for example.
4. Follow the usual workflow of: feature branch (prefix with your initials and then feature name) - PR -> develop branch - PR -> main branch.
5. Please use latest Laravel version.
6. Please use mySQL only as the database backend.
7. Please use latest PHP.

![video demonstration](ComputanTestsDemoVideo.mp4?raw=true "demonstration")

## To Run the project

1. Download or clone the project and Run 
```
composer install
```

```
npm install
```

```
npm run dev
```

```
php artisan migrate:fresh --seed
``` 
(to have a fresh empty database tables)

create .env from .env.example

## Login Details

2. Admin login
http://localhost/project-url/admin
Userame: admin or admin@gmail.com
password: password
3. User login
http://localhost/project-url/login
create new account http://localhost/project-url/register


## To Run Test
Download or clone the project
Run 
```
composer install
```
```
npm install
```
```
npm run dev
```
```
php artisan migrate:fresh --seed
``` 
(to have a fresh empty database tables)

create .env from .env.example

```
php artisan test
```


## to test email job

```
php artisan queue:work or php artisan queue:listen
```
make sure you add a valid email address to relieves the test email.