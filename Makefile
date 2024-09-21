include .env
-include .env.local

.env.local:
	@touch .env.local

install_dependencies:
	composer install
	yarn

create_local_db:
	@touch var/akhilleus.db

migrate_db:
	 php bin/console doctrine:migrations:migrate -n

load_fixtures:
	php bin/console doctrine:fixtures:load -n

init_project: .env.local create_local_db migrate_db load_fixtures

reset_db: create_local_db migrate_db load_fixtures

tests_all:
	XDEBUG_MODE=coverage vendor/bin/phpunit