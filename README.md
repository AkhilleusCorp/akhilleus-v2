[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b331de0c17654f808ff7ee4cb7957ff2)](https://app.codacy.com/gh/AkhilleusCorp/akhilleus-v2/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/b331de0c17654f808ff7ee4cb7957ff2)](https://app.codacy.com/gh/AkhilleusCorp/akhilleus-v2/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_coverage)

## Requirements
 * git
 * docker.io, docker-compose
 * php, php-dom (for grumphp execution on commit)
 * node, npm, yarn (need to be moved to docker)

## Installation
 * clone the repository
 * generates required config files: `make setup`
 * start the backend: `make start`
 * create jwt keys: `docker-compose exec php bin/console lexik:jwt:generate-keypair`
 * build the front end: `yarn install`
 * start the frontend (for dev): `yarn watch`

## Backend tests
 * unit tests only: make tests_unit
 * integration tests only: make tests_integration
 * All tests + coverage: tests_all

## Frontend tests
 * to come