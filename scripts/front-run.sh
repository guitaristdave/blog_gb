#!/bin/bash
# shellcheck disable=SC2006,SC2086,SC2143

cd "`dirname $0`/../" && clear # set root path

echo "Waiting for containers to start..."
while True; do
    STATUS=$(sh scripts/check.sh)
    if [[ $(echo ${STATUS} | grep "ok") ]]; then
        echo "Starting front dev..."
        docker exec -it laravel npm i
        docker exec -dt laravel npm run dev
        break;
    fi
done
