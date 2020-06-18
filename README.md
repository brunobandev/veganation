# Veganation

## Table of Contents
+ [About](#about)
+ [Getting Started](#getting_started)
+ [Usage](#usage)
+ [Contributing](./CONTRIBUTING.md)

## About <a name = "about"></a>
The project was created to demystify a question. But what eats a vegetarian/vegan? And with that, to stimulate the sharing of vegan recipes by the community.

Other ideas are coming up, and we have a lot to grow together. Follow the project! :)

## Getting Started <a name = "getting_started"></a>
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- [Docker](https://docs.docker.com/get-docker/)
- [Docker composer](https://docs.docker.com/compose/install/)

### Installing

### Clone
```bash
$ git clone git@github.com:brunobandev/veganation.git
$ cd veganation
```

### Create an environment file
```bash
$ cp .env.example .env
```

### Create an application key
```bash
$ docker exec veganation-app php artisan key:generate
```

### Containers start
```bash
$ docker-compose up
```

### Install dependencies
```bash
$ docker exec veganation-app composer install
```

### Create tables on database
```bash
$ docker exec veganation-app php artisan migrate
```

### Run tests
```bash
$ docker exec veganation-app ./vendor/bin/phpunit
```

## Usage <a name = "usage"></a>

### Open your favorite browser and text:
```bash
http://localhost:8082
```