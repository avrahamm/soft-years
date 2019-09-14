# Server part
- I used XAMP with apache and virtual hosts,
 I called mt virtual host http://www.soft.test/
- Server is developped in Symfony framework.

- 1) clone 
git clone https://github.com/avrahamm/soft-years.git soft-years
composer install

- 2) According https://symfony.com/doc/current/doctrine.html 
  open .env and set
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

- 3) create DB and populate sample data.
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

- You can check DB tables to assure the data was populated.
 
- 4) There are 2 actions,
- 1) To see all existing years : 
   http://www.soft.test/years 
- 2) to see some year data
  http://www.soft.test/years/2009


# 2) Frontend part.
TBD
