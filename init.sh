#!/bin/bash

# init
docker exec -it sf_php /bin/bash -c 'cd sf; composer install'
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/console doctrine:database:drop --force --if-exists'
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/console doctrine:database:create --if-not-exists'
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/console doctrine:schema:update --force'
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/console doctrine:fixtures:load --append'
docker exec -it sf_php /bin/bash -c 'cd sf; yarn install'
docker exec -it sf_php /bin/bash -c 'cd sf; yarn encore dev'
docker exec -it sf_php /bin/bash -c 'cd sf; php bin/console cache:clear'


