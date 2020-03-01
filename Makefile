user := $(shell id -u)
group := $(shell id -g)
dc :=  docker-compose
dr := $(dc) run --rm
dexec := docker-compose exec
drtest := $(dc) -f docker-compose.test.yml run --rm

.PHONY: help
help: ## Affiche cette aide
	@grep -hE '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: entity
entity: vendor/autoload.php ## CRee une Entity
	php bin/console make:entity

.PHONY: install
install: public/assets vendor/autoload.php ## Installe les différentes dépendances

.PHONY: build-docker
build-docker:
	USER_ID=$(user) GROUP_ID=$(group) docker-compose build php
	USER_ID=$(user) GROUP_ID=$(group) docker-compose build node

.PHONY: crud
crud: vendor/autoload.php ## Cree un Crud pour une classe
	php bin/console make:crud

.PHONY: controller
controller: vendor/autoload.php ## Cree un controller
	php bin/console make:controller

.PHONY: migration
migration: vendor/autoload.php # Cree un migration
	php bin/console make:migration

.PHONY: migrate
migrate: vendor/autoload.php ## Migre la base de donnée
	$(dexec) php php bin/console doctrine:migrations:migrate -q

.PHONY: test
test: vendor/autoload.php ## Execute les testsi
	$(drtest) phptest vendor/bin/phpunit

.PHONY: dev
dev: vendor/autoload.php node_modules/time ## Lance le serveur de développement
	$(dc) up

.PHONY: lint
lint: vendor/autoload.php ## Lint mon code !
	docker run --rm phpstan/phpstan analyse ./vendor/bin/phpstan  analyse src

.PHONY: tt
tt: vendor/autoload.php ## Lance le Watcher de Tests
	$(drtest) phptest vendor/bin/phpunit-watcher watch --filter="nothing" #/vendor/bin/phpunit-watcher watch


.PHONY: seed
seed: vendor/autoload.php ## Génère des données
	$(dexec) php bash -c "php bin/console doctrine:migrations:migrate -q && php bin/console hautelook:fixtures:load -q"

.PHONY: clear ## Nettoie les containers
clear: vendor/autoload.php
	php bin/console cache:clear

.PHONY: bash
bash: ## Ouvre un Terminal dans que container php
	$(dexec) php fish

.PHONY: clean
clean: ## Nettoie les containers
	$(dc) -f docker-compose.yml -f docker-compose.test.yml down --volumes


vendor/autoload.php: composer.lock # installation
	$(dr) --no-deps php composer install
	touch vendor/autoload.php

node_modules/time: yarn.lock #installation
	$(dr) --no-deps node yarn
	touch node_modules/time

public/assets: node_modules/time
	$(dr) --no-deps node yarn run build
	touch node_modules/time

.PHONY: phpcs
phpcs: vendor/autoload.php ## Nettoie les code  en direct!
	vendor/bin/php-cs-fixer fix src/  --rules=@PSR2
.PHONY: db
db: #Lance un Terminal Interactif sur la base de donnée docker
	$(dexec) db mysql -ulinkmat -plinkmat


