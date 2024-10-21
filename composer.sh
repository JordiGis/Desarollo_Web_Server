docker container exec -it php composer install
docker container exec -it php composer update
docker container exec -it php composer self-update
docker container exec -it php composer dump-autoload
docker container exec -it php bash


require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';  


docker run --rm -v $(pwd):/data phpdoc/phpdoc:latest run -d /data/src -t /data/src/docs

sudo docker run --rm -v $(pwd):data phpdoc/phpdoc:latest run -d /data/php/src -t /data/php/docs;

desarollo_web_server