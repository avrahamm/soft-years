I used XAMP with apache and virtual hosts.
Then installed apache-pack, see
https://packagist.org/packages/symfony/apache-pack


Follow https://symfony.com/doc/current/doctrine.html
git clone git-source soft
composer install

# .env
# customize this line!
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# You can check DB tables to assure the data was populated.
