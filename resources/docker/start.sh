#!/usr/bin/env bash

set -e

SLEEP_LENGTH=${SLEEP_LENGTH:=2}
TIMEOUT_LENGTH=${TIMEOUT_LENGTH:=300}

SERVER_ENGINE=${SERVER_ENGINE:="swoole"}
SERVER_HOST=${SERVER_HOST:="0.0.0.0"}
SERVER_PORT=${SERVER_PORT:="8000"}
SERVER_REQUEST_WORKERS=${SERVER_REQUEST_WORKERS:="auto"}
SERVER_TASK_WORKERS=${SERVER_TASK_WORKERS:="auto"}
SERVER_MAX_WORKERS=${SERVER_MAX_WORKERS:="500"}

echo -e "Running container"

if [[ ${#@} -gt 0 ]]; then
    for NODE in "$@"; do
        START=$(date +%s)
        while ! nc -z "${NODE%:*}" "${NODE#*:}"; do
            if [[ $(($(date +%s) - START)) -gt $TIMEOUT_LENGTH ]]; then
                echo -e "\e[31mService ${NODE%:*}:${NODE#*:} did not start within $TIMEOUT_LENGTH seconds. Aborting...\e[0m"
                exit 1
            fi
            echo "Waiting for service ${NODE%:*} to listen on ${NODE#*:}..."
            sleep $SLEEP_LENGTH
        done
        echo -e "\e[32mService ${NODE%:*} ready listening on ${NODE#*:}!\e[0m"
    done
fi

if [[ ! -f "/app/storage/initialized" ]]; then
    # php artisan passport:keys
    # php artisan migrate
    # php artisan db:seed
    # create the initialized file
    date >/app/storage/initialized
fi

php artisan octane:start \
    --server="$SERVER_ENGINE" \
    --host="$SERVER_HOST" \
    --port="$SERVER_PORT" \
    --workers="$SERVER_REQUEST_WORKERS" \
    --task-workers="$SERVER_TASK_WORKERS" \
    --max-requests="$SERVER_MAX_WORKERS"
