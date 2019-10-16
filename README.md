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
  - I used XAMP with apache and virtual hosts, <br/>
  so for client sake, please configure virtual host and call it <br/>
 http://www.soft.server/
   
 <br/> To try server only you can clone to htdocs/soft-years folder 
 <br/> and after completing setup open http://localhost/soft-years/public
  <br/> without virtual host.<br/>
  
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
   http://www.soft.server/years 
 <br/>
- to see specific year data
<br/>
  http://www.soft.server/years/2009
 </p>

# React integrated to symfony
According to <br/>
https://symfony.com/doc/current/frontend/encore/installation.html <br/>
https://symfony.com/doc/current/frontend/encore/simple-example.html <br/>

yarn install <br/>
yarn run encore dev --watch <br/>

To see the app works when frontend React app is integrated into Symfony, <br/>
open <br/>
http://www.soft.server/index <br/>

# 2) Frontend part.
To test when client operates as stand alone React application,<br/>
please see <br/>
https://github.com/avrahamm/soft-years-react-client
