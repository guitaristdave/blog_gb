#!/bin/bash
# shellcheck disable=SC2006,SC2086

cd "`dirname $0`/../" && clear # set root path

if [[ ! -d ./vendor ]] || [[ ! -f ./composer.lock ]]; then
    composer update
fi

docker compose build
docker compose up -d

sh scripts/migrate.sh
sh scripts/front-build.sh

docker compose down
