# Project Title

One Paragraph of project description goes here

### Prerequisites

To run and contribute to this project you will need:
- PHP 7.3
- Composer
- Mysql 5.7

If you prefer the Docker approach you will only need Docker and Docker Compose in order to run the project.

We provide a sample `docker-compose.yml` file with the basic infra needed, than you simply need to run the following:

```
docker-compose up -d
```

### Installing

- Fork and download/clone the project
- Change the `dockerfile.yml` at the root directory to your preferences
- Enter the docker container and run the following commands:
    - `cp .env.example .env` to create a new environment file and replace with your connections information
    - `php artisan migrate` to create the project's tables
    - `php artisan db:seed` to populate the database with base information
    - `php artisan key:generate` to generate an application key

Now you can see the application running on the specified nginx port (80 if not changed).

## Running the tests

The application is covered with Unit and Functional tests, you can run the testsuit through the `vendor/bin/phpunit test/` command or the `php artisan test` command.

## Built With

* [PHP](https://www.php.net/) - The language used
* [Laravel](https://laravel.com/) - The web framework used
* [Composer](https://getcomposer.org/) - The PHP dependency manager

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Bruno Bandeira** - *Initial work* - [Bruno Bandeira](https://github.com/brunobandev)

See also the list of [contributors](https://github.com/brunobandev/veganation/contributors) who participated in this project.

## License

This project is licensed under the XXX License - see the [LICENSE.md](LICENSE.md) file for details
