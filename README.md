# The World Seed - Personae

First build the image:

```bash
docker build . --file=resources/docker/Dockerfile --tag=the-seed/personae:latest
```

Docker compose deployment file:

```yaml
version: '3'

networks:
    the-seed:
        driver: bridge

services:
    personae:
        container_name: personae
        image: the-seed/personae:latest
        restart: unless-stopped
        depends_on:
            - database
        command: database:3306
        environment:
            APP_ENV: 'development'
            APP_KEY: '<replace with a valid key from https://generate-random.org/laravel-key-generator>'
            APP_DEBUG: 'true'
            LOG_CHANNEL: 'stderr'
            LOG_LEVEL: 'debug'
            DB_CONNECTION: 'mysql'
            DB_HOST: 'database'
            DB_PORT: '3306'
            DB_DATABASE: 'personae'
            DB_USERNAME: 'personae'
            DB_PASSWORD: '<db-password>'
        ports:
            - '8000:8000'
        networks:
            - the-seed
    database:
        container_name: database
        image: mysql/mysql-server:8.0
        environment:
            MYSQL_ALLOW_EMPTY_PASSWORD: 1
            MYSQL_ROOT_HOST: '127.0.0.1'
            MYSQL_ROOT_PASSWORD: '<db-password>'
            MYSQL_DATABASE: 'personae'
            MYSQL_USER: 'personae'
            MYSQL_PASSWORD: '<db-password>'
        ports:
            - '3306:3306'
        networks:
            - the-seed
```
