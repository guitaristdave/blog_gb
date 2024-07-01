#!/bin/bash
# shellcheck disable=SC2006,SC2053,SC2086,SC2143

cd "`dirname $0`/../" && clear # set root path

SERVICES=(mysql laravel.test)
SERVICES_STATUSES=("healthy" "running")
SERVICES_IDS=()

WAITING=0
for (( i=0; i<${#SERVICES[@]}; i++ )) do
    SERVICES_IDS[$i]=$(docker-compose ps -q ${SERVICES[$i]})
    STATUS_FULL=$(docker ps --filter id=${SERVICES_IDS[$i]} --filter status=running --format "{{.Status}}")

    if [[ $(echo ${STATUS_FULL} | grep "healthy") ]]; then
        STATUS="healthy"
    elif [[ $(echo ${STATUS_FULL} | grep "starting") ]]; then
        STATUS="starting"
    else
        STATUS="running"
    fi

    if [[ ${STATUS} != ${SERVICES_STATUSES[$i]} ]]; then
        WAITING=1
        break;
    fi
done

if [[ ${WAITING} == 0 ]]; then
    echo "ok"
else
    echo "error"
fi
