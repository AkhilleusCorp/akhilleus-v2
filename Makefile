include .env
-include .env.local

.env.local:
	@touch .env.local

install_dependencies:
	composer install
	yarn

up:
	docker compose up -d
	sleep 3

down:
	docker compose down --remove-orphan

create_local_db:
	docker compose exec php bin/console doctrine:database:drop --force --if-exists
	docker compose exec php php bin/console doctrine:database:create
	docker compose exec php php bin/console doctrine:migrations:migrate -n

remove_local_db:
	docker compose down --remove-orphan

load_fixtures:
	docker compose exec php php bin/console doctrine:fixtures:load -n

init_project: .env.local up create_local_db load_fixtures

reset_db: create_local_db load_fixtures

start: up create_local_db load_fixtures

create_test_db:
	php bin/console doctrine:database:drop --if-exists --force --env=test
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:schema:create -n --env=test

load_test_fixtures:
	php bin/console doctrine:fixtures:load -n --env=test

reset_test_db: create_test_db load_test_fixtures

tests_all:
	rm -rf var/cache/test #prevent test failing due to outdated cache
	XDEBUG_MODE=coverage vendor/bin/phpunit

mysql_connect_akhilleus: ## Connect to core database
	docker compose exec database /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD $$MYSQL_DB_NAME'