#!/bin/bash
# shellcheck disable=SC2006,SC2086

cd "`dirname $0`/../" && clear # set root path

docker compose up -d
sh scripts/front-run.sh
