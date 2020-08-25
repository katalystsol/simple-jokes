# Simple Jokes Demo Application

## Requirements
- PHP 7.2.5 or higher
- PDO-SQLite PHP extensions enabled

## Installation


## Usage

### Seeding the joke database (pre-population)
- from the command console run: `php bin/console doctrine:fixtures:load`

### Running locally
- from the command console run: `symfony server:start`
    - This will make the API available via http://127.0.0.1:8000 (e.g. go to http://127.0.0.1:8000/api/jokes in browser or Postman)

### Creating/adding jokes
- basic validation:
    - joke must be a minimum of 10 characters

## Tests
Run migration and load fixtures

- `php bin/console doctrine:migrations:migrate --env=test`
- `php bin/console doctrine:fixtures:load --env=test`

Run PHPUnit
- `php bin/phpunit`
