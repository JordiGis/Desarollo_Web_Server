docker container exec -it php composer install
docker container exec -it php composer update
docker container exec -it php composer self-update
docker container exec -it php composer dump-autoload

require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';  