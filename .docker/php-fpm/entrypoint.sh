#!/bin/sh

#set -e
#bin/console cache:clear

############## doctrine

echo "DB INTEGRATION asked "
#bin/console doctrine:database:drop --force
bin/console doctrine:database:create --if-not-exists --no-interaction
bin/console doctrine:migrations:migrate --no-interaction

echo "Cache clear"
bin/console cache:clear --no-warmup --env=prod

echo "Assets Install"
bin/console assets:install
chmod -R 777 var/

############## supervisor

exec "$@"
