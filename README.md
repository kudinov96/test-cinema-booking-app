# test-cinema-booking-app
### Steps install:
<ul>
    <li>cd docker</li>
    <li>docker-compose up -d --build</li>
    <li>docker exec -itu1000 docker_php-fpm_1 bash</li>
    <li>composer install</li>
    <li>php bin/console doctrine:fixtures:load</li>
</ul>
