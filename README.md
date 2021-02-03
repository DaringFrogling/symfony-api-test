# Test task for Swivl
This project is a test task for Swivl running `Symfony 4.4` via `docker-compose`.

## Setting up
First clone the repo or download it as a zip.
You should have installed `Docker`. 
`Docker-compose` file contains 4 services: mysql5.7, nginx, php-7.4 and adminer.
Within a directory of your project use
```console
$ docker-compose up
```

You need to install the dependencies with Composer via Docker.
```console
$ docker-compose exec php74 bash
$ composer self-update --2
$ composer install
``` 

Setup up DB, take care of migration.
```console
$ symfony console doctrine:database:import dump.sql
```
If you've got a migration, or some other process which creates new tables and you also want them removed, just kill the database and create it again:

```console
$ symfony console doctrine:database:drop --force
$ symfony console doctrine:database:create
$ symfony console doctrine:database:import dump.sql
```


###Once you are done
The api is accessible at `http://localhost:8080/api/v1/`.
List of endpoints:
```
/ GET     List of classrooms - http://localhost:8080/api/v1/ 
/ GET     Select the classroom by id - http://localhost:8080/api/v1/{id}
/ POST    Insert the classroom - http://localhost:8080/api/v1/
/ DELETE  Delete the classroom - http://localhost:8080/api/v1/{id}
/ PATCH   Edit the classroom - http://localhost:8080/api/v1/{id}
```