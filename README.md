# Clone Repository
Go to your terminal and clone the repository:
```sh
git clone https://github.com/archieem/jr-webdev-crm-exam
```

After cloning the repository,go to the **jr-webdev-crm-exam** directory:

```sh
cd jr-webdev-crm-exam
```

Once you're in the **jr-webdev-crm-exam** directory, install all dependencies.

```sh
composer install
```

```sh
npm install
```

After installing dependencies, set-up your env.

## Setup

Duplicate the .env.example located in your jr-webdev-crm-exam root:

```sh
cp .env.example .env
```

After duplicating .**env**, create a jr_webdev_crm_exam database then

Setup also your database connection

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jr_webdev_crm_exam
DB_USERNAME=root
DB_PASSWORD=
```
Run the migration and the seeder:

```sh
php artisan migrate:fresh --seed
```

Create your app key with the command:

```sh
php artisan key:generate
```


Lastyly run the app with the command:
 
```sh
php artisan serve
```

After all the set-up, you can check the app which runs on **http://localhost:8000**

## Note

If you encounter problem, try clearing the cache, etc., 

```sh
php artisan optimize:clear
```

Then run the servers again:

```sh
php artisan serve
```

## Example user

email: user1@test.com
password: password123

email: user2@test.com
password: password123

# Assumption
I developed a simple CRUD System using Laravel that follows clean architecture practices with the use of a Controller, Repository Pattern, and Form Request Validation.

The system allows users to create new client records by entering the client’s name, email, and status. Input data is validated before saving to ensure accuracy and data integrity. Users can also view all existing clients in a list with a search functionality for easier record filtering.
