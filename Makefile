start:
	docker-compose up --build -d

stop:
	docker-compose down

php:
	docker-compose exec php sh

update:
	docker-compose build --no-cache
