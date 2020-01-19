# Test GraphQL

A little GraphQL test.

## Installation

Clone the project, then run the following commands:

```bash
$ composer install
$ docker-compose up -d
$ php bin/console server:run
$ php bin/console doctrine:migrations:migrate
```

You can access GraphiQL interface at the following address: 
```bash
http://localhost:8000/graphiql
```