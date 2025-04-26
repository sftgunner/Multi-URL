# Multi-URL

### Example docker-compose.yml

```yaml
version: "3.8"
services:

  # PHP Service
  webserver:
    build: .
    environment:
      MYSQL_SERVER_MULTIURL: "multiurl_db" # set this to the name of the MariaDB service
      MYSQL_PORT_MULTIURL: 3306
      MYSQL_DB_MULTIURL: "multiurl"
      MYSQL_USER_MULTIURL: "multiurl_db_public"
      MYSQL_PASSWORD_MULTIURL: {INSERT HERE}
      RECAPTCHA_SECRET_MULTIURL: {INSERT HERE}
    ports:
      - "{SELECT YOUR PORT}:80"
    volumes:
      - ./:/var/www/html/
    networks:
      - npm_npm-network
      - multiurl-network

  # MariaDB Service
  mariadb:
    container_name: multiurl_db
    image: mariadb:10.11
    environment:
      MYSQL_RANDOM_ROOT_PASSWORD: "true"
      MYSQL_DATABASE: "multiurl"
      MYSQL_USER: "multiurl_db_public"
      MYSQL_PASSWORD: {INSERT HERE}
    volumes:
      - mysqldata:/var/lib/mysql # ensures the database is persistent
      - ./mysql-startup:/docker-entrypoint-initdb.d # contents of this runs on startup
    networks:
      - multiurl-network
      

# Volumes
volumes:
  mysqldata: # this is managed by docker - to clear use docker exec -it multi-url-mariadb-1 bash

# Networks
networks:
  multiurl-network:
    driver: bridge
```