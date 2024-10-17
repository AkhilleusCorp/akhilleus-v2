include .env
-include .env.local

PHP := docker compose exec php

.env.local:
	touch .env.local

.php-cs-fixer.php: .php-cs-fixer.dist.php
	cp .php-cs-fixer.dist.php $@

setup: .env.local .php-cs-fixer.php

install_dependencies:
	${PHP} composer install
	yarn

up:
	docker compose up -d
	sleep 3

down:
	docker compose down --remove-orphan

create_local_db:
	$(PHP) bin/console doctrine:database:drop --force --if-exists
	$(PHP) bin/console doctrine:database:create
	$(PHP) bin/console doctrine:migrations:migrate -n

remove_local_db:
	docker compose down --remove-orphan

load_fixtures:
	$(PHP) bin/console doctrine:fixtures:load -n

init_project: .env.local up create_local_db load_fixtures

reset_db: create_local_db load_fixtures

start: up install_dependencies create_local_db load_fixtures

tests_unit:
	$(PHP) vendor/bin/simple-phpunit --testsuite unit

tests_integration:
	$(PHP) bin/console cache:clear
	$(PHP) vendor/bin/simple-phpunit --testsuite integration

tests_all:
	XDEBUG_MODE=coverage $(PHP) vendor/bin/simple-phpunit

mysql_connect_akhilleus: ## Connect to core database
	docker compose exec database /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DB_NAME'