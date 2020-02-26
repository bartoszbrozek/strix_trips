# Trips

## Installation

Create `.env` file based on `.env.example` file and set database connection

### Create database

```
bin/console doctrine:database:create
```

### Make migration

```
bin/console make:migration
```

### Create tables

```
bin/console doctrine:migrations:migrate
```

### Populate database with data fixtures

```
bin/console doctrine:fixtures:load
```

## Functionalities

### Calculate average speed of trips in database

```
bin/console trips:calculate
```