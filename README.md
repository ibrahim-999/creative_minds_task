# Creative Minds Task

## Task Description

Please make the following task using laravel 8+ (latest build):
1- install Laravel Telescope and make sure to log all actions and error. Log every thing and send the full db dump with the task (mandatory).
2- make all authentications with JWT.
3- login api with mobile number and password.
4- register a new account using mobile number, password, username (use twilio sms gateway to send sms to verify mobile number).
5- Create API for getting profile data.
6- Make an “admin panel”/Control panel with CRUD for users.
NOTE:
-make sure You’ll handle user verification code  sent by sms
-make sure You’ll handle a not completed profile trying to login even he didn’t add the sms code
-make all needed validation in Admin panel
- Don’t forget to share the postman collection for the task
- Save the dummy data by using the seeder

## Prerequisite
- PHP 8.2
- Laravel 9.19
- Mysql for database
- php-open-source-saver/jwt-auth
- spatie/laravel-backup
- twilio/sdk
- andreaselia/laravel-api-to-postman

## Installation

### Step 1.
- Begin by cloning this repository to your machine
```
git clone `repo url` 
```

- Install dependencies
```
composer install,
npm install && npm run dev
```

- Create environmental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the project's .env file.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

- Run migration
```
php artisan migrate or php artisan migrate:fresh
```

### Step 3
- before start, you need to run table seeders
```
php artisan db:seed
```

### Step 4
- To start the server, run the command below
```
php artisan serve
```

## Application Route
```
http://127.0.0.1:8000
```

## Additional requirements 
- you need to register to Twilio WebSite to get your account verified and in order to ues the service
- ``` https://www.twilio.com/```
- you need to register two keys into .env file 
- ``TWILIO_SID,TWILIO_AUTH_TOKEN`` for twilio package
- you need to generate jwt keys by writing this command 
```
  php artisan jwt:secret
  JWT_SECRET=xxxxxxxx
```

## Author
- ibrahim khalaf
