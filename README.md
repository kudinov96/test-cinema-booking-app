# test-cinema-booking-app
### Steps install:
<ul>
    <li>cd docker</li>
    <li>docker-compose up -d --build</li>
    <li>docker exec -itu1000 docker_php-fpm_1 bash</li>
    <li>composer install</li>
    <li>php bin/console doctrine:database:create</li>
    <li>php bin/console doctrine:migrations:migrate</li>
    <li>php bin/console doctrine:fixtures:load</li>
</ul>

### Install Tests
<ul>
    <li>docker volume rm docker_dbdata</li>
    <li>docker-compose up -d</li>
    <li>docker exec -itu1000 docker_php-fpm_1 bash</li>
    <li>APP_ENV=test php bin/console doctrine:database:create</li>
    <li>APP_ENV=test php bin/console doctrine:migrations:migrate</li>
    <li>APP_ENV=test php bin/console doctrine:fixtures:load</li>
    <li>php bin/console doctrine:fixtures:load</li>
</ul>

#### Start tests
<ul>
    <li>php bin/phpunit</li>
</ul>