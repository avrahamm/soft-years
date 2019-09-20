# Server part
- Server is developped in Symfony framework, <br/>
 uses Doctrine, Cache and JMSSerializer.<br/>
 The application doesn't restrict origins  <br/>
 to avoid CORS error when requested by clients from different domain.
<p>
- 1) clone 
<br/>
git clone https://github.com/avrahamm/soft-years.git soft-years
  <br/>
 cd soft-years
  <br/>
  - I used XAMP with apache and virtual hosts, 
  for example http://www.soft.years/ 
 <br/> or clone to htdocs/soft-years folder 
 <br/> and after completing setup open http://localhost/soft-years/public
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
- to see specific year data
<br/>
  http://www.soft.test/years/2009
 </p>

# 2) Frontend part.
Client will operate as stand alone application.
https://github.com/avrahamm/soft-years-react-client
