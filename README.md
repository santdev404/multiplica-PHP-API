# MultiplicaFront

The scope of PHP API Restful application is to generate CRUD endpoints.
The list of endpoint:
- Register
- Login
- Color index
- Color show
- Color edit
- Color store
- Color update
- Color delete

The project has two github repositories,

For PHP API Backend: https://github.com/santdev404/multiplica-PHP-API

For Angular Frontend: https://github.com/santdev404/multiplica-Front

The communications between PHP backend and Angular Frontend is through URL with API calls.

## Technologies

Backend
LAMP stock
- PHP 7.4.3
- Laravel 8.0
- MariaDB
- Apache
- Composer
- Firebase/JWT

Frontend
- Node v16.2.0
- NPM  7.13.0
- Angular Cli 12

Below are the instructions to setup all the tools and config all the requires php files. 
I strongly recommend to perform all the installations on a machine with Ubuntu 20.0 operational system.

## PHP
Please follow the below instrution to setup the PHP enviroment:

- Install LAMP stock
- Once the LAMP stock is installed and running, create the folder 'projects' inside the directory /var/www/html/
- Move to /var/www/html/projects/ directory and download the multiplica-PHP-API respository
- Next move inside the directory /var/www/html/projects/mutiplicaApi

## Install Composer Dependencies

```
composer install

```

## Install NPM Dependencies

```
npm install

```

## Create a copy of your .env file
```
cp .env.example .env

```
## Generate an app encryption key
```
php artisan key:generate

```
## Database
### In the .env file, add database information to allow Laravel to connect to the database

- Create a database with the name "Multiplica"
- Inside the .env file enter a valid username & password for Multiplica database

```
DB_USERNAME=username
DB_PASSWORD=password

```

- Once your credentials are in the .env file, now you can migrate your database.

```
php artisan migrate

```

- Seed the database

```
php artisan db:seed

```

## Virtual Host configuration
### The next set of steps are related to Set Up Apache Virtual Hosts on Ubuntu.

- Open a new terminal and change the ownership of the project

```
 sudo chown -R $USER:$USER /var/www/html/projects/mutiplicaApi/public_html

```

- Ensure that read access is permitted to the general web directory and all of the files and folders it contains so that pages can be served correctly: 

```
 sudo chmod -R 755 /var/www

```

- Create New Virtual Host Files

```

sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/multiBack.com.conf


```
- Open the new file in your editor with root privileges:

```
sudo nano /etc/apache2/sites-available/multiBack.com.conf

```

- Copy the following content inside multiBack.com.conf

```
<VirtualHost *:80>
    ServerAdmin admin@example.com
    ServerName multiBack.com
    ServerAlias www.multiBack.com
    DocumentRoot /var/www/html/projects/mutiplicaApi/public


    <Directory /var/www/html/projects/mutiplicaApi/public >
        Options Indexes FollowSymLinks MultiViews
        AllowOverride all
        Order allow,deny
        allow from all
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined


</VirtualHost>
```

-  Enable the New Virtual Host Files


```
sudo a2ensite multiBack.com.conf

```

- Next, disable the default site defined in 000-default.conf:


```
sudo a2dissite 000-default.conf

```

- Next restart Apache to make these changes take effect:

```
sudo systemctl restart apache2

```

— Set Up Local Hosts File

```
sudo nano /etc/hosts
```

- Add the following lines to the bottom of my hosts file:

```
127.0.0.1       multiBack.com
```

- Enabling mod_rewrite & restart apache

```
sudo a2enmod rewrite
sudo systemctl restart apache2
```

