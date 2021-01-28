# Test task for Swivl
This project is a test task for Swivl running Symfony 4.4 via docker-compose.

## Setting up
First clone the repo or download it as a zip.
You should have installed Docker. 
Docker-compose file contains 4 services: mysql5.7, nginx, php-7.4 and adminer.
Within a directory of your project use `docker-compose up --build`.

You need to install the dependencies with Composer via Docker
`docker exec -it swivl-app bash &&
composer install`.

https://symfony.com/doc/4.4/setup.html

[comment]: <> (>Setup your DB, .env file, take care of )

[comment]: <> (migration. If you're in doubt, the reading the )

[comment]: <> (tutorial should get you in the right track.)

[comment]: <> (####For checking if your DB is installed:)

[comment]: <> (Paste `docker exec -it mysql57 bash` to your terminal.)

[comment]: <> (Now you're in *mysql57* container environment. Next you should log in mysql `mysql -u someuser -p somepassword`. And yes, write `show databases` for check if your db is installed.)


[comment]: <> (| Database           |)

[comment]: <> (|:---:|)

[comment]: <> (| information_schema |)

[comment]: <> (| mysql              |)

[comment]: <> (| performance_schema |)

[comment]: <> (| swivl-test-api     |)

[comment]: <> (| sys                |)



###Once you are done
The api is accessible at `http://localhost:8080/api/`