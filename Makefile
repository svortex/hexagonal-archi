DOCKER_COMPOSE = docker-compose
WORKING_DIR    = /var/www/app
EXEC_PHP       = $(DOCKER_COMPOSE) exec php
SYMFONY        = $(EXEC_PHP) bin/console
ENV            = dev
COMPOSER       = $(EXEC_PHP) composer
BIN_DIR        = ./vendor/bin

up: ## Start Containers
up:
	@$(DOCKER_COMPOSE) up -d

kill: ## Stop & Remove Containers
kill:
	@$(DOCKER_COMPOSE) down --remove-orphans

stop: ## Stop the project
	@$(DOCKER_COMPOSE) stop

restart: ## Restart the project
	@$(DOCKER_COMPOSE) restart

cli: ## Get into php container interactive mode
cli:
	@$(EXEC_PHP) bash

phpstan: ## Run phpstan
	@echo "$(BLUE)Running phpstan...$(NO_COLOR)"
	@$(EXEC_PHP) php -d memory_limit=-1 $(BIN_DIR)/phpstan analyse src tests

watcher: ## Run phpunit-watcher
	@$(EXEC_PHP) php $(BIN_DIR)/phpunit-watcher watch

test:
	@$(EXEC_PHP) $(BIN_DIR)/pest
phpcs-fix: ## Run phpcs and fix
phpcs-fix: vendor
	@echo "$(BLUE)Running php cs fixer...$(NO_COLOR)"
	@$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --config=.php_cs -v

install: 
	@$(EXEC_PHP) composer install

ci: install test phpstan 