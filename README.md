# Docker for backend internships

1. Скопируйте репозиторий
2. Запустите `docker-compose up -d --build` из директории `docker`
3. Зайтиде в контейнер командой `docker exec -itu1000 docker_php-fpm_1 /bin/bash`
4. Запустите установку symfony cli командой `curl -sS https://get.symfony.com/cli/installer | bash`
5. Разверните проект symfony командой `/var/www/.symfony/bin/symfony new app`
6. Удалите директорию `public` из корневой директории проекта
7. Переместите все файлы из директории `app` в корневую директорию проекта
8. Пустую директорию `app` можно удалить
# test-cinema-booking-app
