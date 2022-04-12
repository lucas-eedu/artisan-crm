<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Artisan CRM
Artisan CRM (Customer Relationship Management) is an open source software developed using the [Laravel](https://laravel.com/) framework and the [AdminLTE](https://adminlte.io/) template in the MVC standard.

## Requirements Docker Installation
- [Kool.dev](https://koo.dev/);
- [Docker and Docker Compose](https://docker.com/);

## Requirements Local Installation
- [PHP](https://www.php.net/manual/en/install.php);
- [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/);
- [Node](https://nodejs.org/en/download/);
- [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm);
- [Yarn](https://classic.yarnpkg.com/lang/en/docs/install/);
- [Composer](https://getcomposer.org/);
- Apache or Nginx.

## Docker Installation (Recommended)

1. Installing via github:

```bash
git clone https://github.com/lucas-eedu/artisan-crm.git
```

2. Access the project directory.

2. Run the command for kool to build the project
```bash
kool run setup
```

3. Accessing the CRM locally:
- In your browser, access the URL http://localhost
- Access CRM with email: super@artisan.com.br and password: admin@123
- Access CRM with email: admin@artisan.com.br password: admin@123
- Access CRM with email: seller@artisan.com.br password: admin@123

## Local Installation
You can install this project via github or by downloading the zipped repository.

1. Installing via github:

```bash
git clone https://github.com/lucas-eedu/artisan-crm.git
```

2. Create a new database in your MySQL;

3. Access the project directory:

```bash
cp .env.local.example .env
```

4. Configuring the .env file with your data:
- On line 13 replace "your_database" with the name of the database you created in step 2
- On line 14 replace "mysql_username" with your MySQL username
- On line 15 replace the "mysql_password" with the password of your MySQL user

5. Run the commands:

    To install project dependencies
    ```bash
    composer install && yarn install && yarn dev
    ```

    It is used to define a new key in your .env file which is used by Laravel's encryption service - Illuminate.
    ```bash
    php artisan key:generate
    ```

    Create a symbolic link between a subfolder in your storage directory (public/storage) and the public directory (storage/app/public).
    ```bash
    php artisan storage:link
    ```

    Run all project migrations.
    ```bash
    php artisan migrate
    ```

    Runs all project seeds.
    ```bash
    php artisan db:seed
    ```

    Start a development server for the Laravel project
    ```bash
    php artisan serve
    ```

6. Accessing the CRM locally:
- In your browser, access the URL http://localhost
- Access CRM with email: super@artisan.com.br and password: admin@123
- Access CRM with email: admin@artisan.com.br password: admin@123
- Access CRM with email: seller@artisan.com.br password: admin@123

## Contribuidores
Thank you for considering contributing to Artisan CRM. Any kind of contribution is welcome, send a PR!
