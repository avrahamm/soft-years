# Server part
- I used XAMP with apache and virtual hosts, 
  for example host http://www.soft.years/ 
 <br/>
- Server is developped in Symfony framework.
<p>
- 1) clone 
<br/>
git clone https://github.com/avrahamm/soft-years.git soft-years
  <br/>
 cd soft-years
<br/>
composer install
</p>
<p>
- 2) According https://symfony.com/doc/current/doctrine.html 
  open .env and set
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
</p>

<p>
- 3) create DB and populate sample data.
 <br/>
php bin/console doctrine:database:create
<br/>
php bin/console doctrine:migrations:migrate
<br/>
php bin/console doctrine:fixtures:load
<br/>
- You can check DB tables to assure the data was populated.
  </p>

<p>
- 4) There are 2 actions,
- years numbers To get all existing years : 
<br/>
   http://www.soft.test/years 
 <br/>
- to see some specific year data
<br/>
  http://www.soft.test/years/2009
 </p>

# 2) Frontend part.
TBD
