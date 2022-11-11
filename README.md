# The World Seed - Personae

First build the image:

```bash
docker build . --file=resources/docker/Dockerfile --tag=the-seed/personae:latest
```

Docker compose deployment file:

```yaml
version: '3'
services:
    personae:
        container_name: personae
        image: the-seed/personae:1.0
        restart: unless-stopped
        depends_on:
            - 'database'
        command: 'database:${DB_PORT}'
        environment:
            APP_ENV: '${APP_ENV}'
            APP_KEY: '${APP_KEY}'
            APP_DEBUG: '${APP_DEBUG}'
            LOG_CHANNEL: '${LOG_CHANNEL}'
            LOG_LEVEL: '${LOG_LEVEL}'
            DB_CONNECTION: '${DB_CONNECTION}'
            DB_HOST: '${DB_HOST}'
            DB_PORT: '${DB_PORT}'
            DB_DATABASE: '${DB_DATABASE}'
            DB_USERNAME: '${DB_USERNAME}'
            DB_PASSWORD: '${DB_PASSWORD}'
        ports:
            - '8000:8000'
        networks:
            - the-seed
    database:
        container_name: database
        image: mysql/mysql-server:8.0
        environment:
            MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ROOT_HOST: '%'
            MYSQL_DATABASE: '${DB_DATABASE}'
            MYSQL_USER: '${DB_USERNAME}'
            MYSQL_PASSWORD: '${DB_PASSWORD}'
            MYSQL_ALLOW_EMPTY_PASSWORD: 1
        ports:
            - '${DB_PORT}:${DB_PORT}'
        networks:
            - the-seed
        healthcheck:
            test: [ 'CMD', 'mysqladmin', 'ping', '-p${DB_PASSWORD}' ]
            retries: 3
            timeout: 5s
        volumes:
            - 'personae-mysql:/var/lib/mysql'
networks:
    the-seed:
        driver: bridge
volumes:
    personae-mysql:
        driver: local

```
