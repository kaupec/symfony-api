# Symfony API example

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`
4. Create `.env.local` based on `.env` file
5. Run `bin/console doctrine:database:create`
6. Run `bin/console doctrine:migration:migrate`

### Working

1. Run `php bin/console server:run` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets
3. Go to homepage `/` to see API Documentation