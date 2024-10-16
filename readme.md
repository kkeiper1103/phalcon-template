# Phalcon Template

This is a dockerized Phalcon application template that uses 
Laravel-esque code styles. The structure is very similar 
to how laravel/laravel lays out its code.

Everything website specific lives within the `site/` folder,
while everything docker specific lives in the root of the
project.

## Running
Just use `docker compose up` in the root of the project. 

That command will download the docker images needed (ubuntu/ubuntu and ubuntu/mysql),
build the `application` image, and then proxy port 8080 to the local box. Access
`http://localhost:8080` to see the site.

If you would like to change the initial schema, modify the `docker-compose/mysql/init-db.sql` script.

## todo
- Implement global helpers like `config("app.providers")` and `env("APP_ENV")`
- Use [illuminate/database](https://github.com/illuminate/database) for migrations
  instead of the jankiness of phalcon migrations. Since migrations will only be ran
  manually (not every request), it doesn't have to be a compiled component
- Add something like [filp/whoops](https://github.com/filp/whoops) for errors
- Add logger handler
- Add session handler
- Add cache handler
