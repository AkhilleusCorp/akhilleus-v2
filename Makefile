include .env
-include .env.local

.env.local:
	@touch .env.local

install_dependencies:
	composer install
	yarn

create_local_db:
	@touch var/akhilleus.db

remove_local_db:
	rm -f var/akhilleus.db

migrate_db:
	 php bin/console doctrine:migrations:migrate -n

load_fixtures:
	php bin/console doctrine:fixtures:load --purge-with-truncate -n

init_project: .env.local create_local_db migrate_db load_fixtures

reset_db: remove_local_db create_local_db migrate_db load_fixtures


create_test_db:
	@touch var/akhilleus-test.db

remove_test_db:
	rm -f var/akhilleus-test.db

migrate_test_db:
	 php bin/console doctrine:migrations:migrate -n --env=test

load_test_fixtures:
	php bin/console doctrine:fixtures:load -n --purge-with-truncate --env=test

init_test_env: create_test_db migrate_test_db

reset_test_db: remove_test_db init_test_env load_test_fixtures

tests_all:
	XDEBUG_MODE=coverage vendor/bin/phpunit