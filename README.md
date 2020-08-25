# Simple Jokes Demo Application

## Requirements
- PHP 7.2.5 or higher
- PDO-SQLite PHP extensions enabled

## Installation
If you do not already have the symfony binary installed, install it first via https://symfony.com/download.

From the command line:
1. Clone the repository in desired location:
    - `git clone git@github.com:katalystsol/simple-jokes.git`
2. Install the packages (assumes that you have composer installed)
    - `cd simple-jokes`
    - `composer install`
3. Migrate the database tables
    - `php bin/console doctrine:migrations:migrate`
4. Seed the database with jokes (optional)
    - `php bin/console doctrine:fixtures:load`
5. Run the server
    - `symfony server:start`

## API Documents
- Swagger / OpenAPI doc:
    - [Swagger HTML on Swagger Server](<a href="https://app.swaggerhub.com/apis-docs/KatalystSolutions/SimpleJoke/1.0.0">)
    - [Swagger HTML local copy](<a href="/docs/openapi/html2-documentation-generated/index.html">)
    - [OpenAPI Spec YAML](docs/openapi/openapi-yaml-client-generated/openapi.yaml)
- [Postman Collection](docs/postman/Simple-Jokes.postman_collection.json)

## Usage

### Seeding the joke database (pre-population)
- from the command console run if not done during installation: `php bin/console doctrine:fixtures:load`

### Running locally
- from the command console run: `symfony server:start`
    - This will make the API available via http://127.0.0.1:8000 (e.g. go to http://127.0.0.1:8000/api/jokes in browser or Postman)

### Creating/adding jokes
- basic validation:
    - joke must be a minimum of 10 characters

### Accessing the API
It can be accessed via Curl. For example:
    - `curl http://127.0.0.1:8000/api/jokes`

Or it can be accessed via the browser or using Postman.

## Tests
Note: the tests have been started but have not been fully implemented.

Run migration and load fixtures

- `php bin/console doctrine:migrations:migrate --env=test`
- `php bin/console doctrine:fixtures:load --env=test`

Run PHPUnit
- `php bin/phpunit`
