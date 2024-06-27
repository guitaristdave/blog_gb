#!/bin/bash
# shellcheck disable=SC2006,SC2086,SC2143

cd "`dirname $0`/../" && clear # set root path

WAITING=1
echo "Waiting for containers to start..."
while [[ ${WAITING} == 1 ]]; do
    STATUS=$(sh scripts/check.sh)
    if [[ $(echo ${STATUS} | grep "ok") ]]; then
        WAITING=0
        echo "Starting front dev..."
        docker exec -it laravel npm i
        docker exec -dt laravel npm run dev
    fi
done
