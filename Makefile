.PHONY: test

test:
	docker-compose up -d
	docker exec php_app vendor/bin/phpunit ./tests
	docker-compose down

phpstan:
	docker-compose up -d
	docker exec php_app vendor/bin/phpstan analyse --level=max ./app
	docker-compose down