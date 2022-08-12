# LumenApi
docker compose up -d
docker exec -it lumenapi-php-1 php composer.phar install
docker exec -it lumenapi-php-1 php artisan migrate
