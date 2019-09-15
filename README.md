# Server part
- I used XAMP with apache and virtual hosts, 
<br/>
 I called my virtual host http://www.soft.test/ 
 <br/>
- Server is developped in Symfony framework.

- 1) clone 
git clone https://github.com/avrahamm/soft-years.git soft-years
<br/>
composer install
<br/>
- 2) According https://symfony.com/doc/current/doctrine.html 
  open .env and set
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
<br/>
- 3) 
<p>
create DB and populate sample data.
php bin/console doctrine:database:create
<br/>
php bin/console doctrine:migrations:migrate
<br/>
php bin/console doctrine:fixtures:load
<br/>

- You can check DB tables to assure the data was populated.
  </p>

- 4) 
 <p>
There are 2 actions,
- years numbers To get all existing years : 
<br/>
   http://www.soft.test/years 
- to see some specific year data
<br/>
  http://www.soft.test/years/2009
 </p>

# 2) Frontend part.
TBD
