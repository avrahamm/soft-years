1) Server part
- I used XAMP with apache and virtual hosts.
- Then installed apache-pack, see
https://packagist.org/packages/symfony/apache-pack
I called my virtual host http://www.soft.test/

Follow https://symfony.com/doc/current/doctrine.html

git clone https://github.com/avrahamm/soft-years.git soft-years
composer install

# .env
# customize this line!
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# You can check DB tables to assure the data was populated.
# There are 2 actions,
# 1) To see all existing years : 
   http://www.soft.test/years 
# 2) to see some year data
  http://www.soft.test/years/2009

2) Frontend part.
TBD
