#!/bin/bash
# shellcheck disable=SC2006,SC2086

cd "`dirname $0`/../" && clear # set root path

WAITING=1
echo "Waiting for containers to start..."
while [[ ${WAITING} == 1 ]]; do
    STATUS=$(sh scripts/check.sh)
    if [[ ${STATUS} =~ (.*)(ok)(.*) ]]; then
        WAITING=0
        echo "Starting front build..."
        docker exec -it laravel npm i
        docker exec -it laravel npm run build
    fi
done
