docker container exec -it php composer isntall
docker container exec -it php composer update
docker container exec -it php composer slef-update
docker container exec -it php composer dump-autoload

require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';  