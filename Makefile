.PHONY: test

test:
	docker-compose up -d
	docker exec php_app vendor/bin/phpunit ./tests
	docker-compose down