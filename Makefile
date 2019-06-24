include Make.config

install: composer cc migrate-up assets generate-models

composer:
ifeq ($(ENVIRONMENT_DEBUG), false)
	export SYMFONY_ENV=prod; sudo php composer.phar install --optimize-autoloader --no-interaction
else
	php composer.phar install --optimize-autoloader --no-interaction
endif

cc:
	rm -rf var/cache/*
ifeq ($(ENVIRONMENT_DEBUG), false)
	php bin/console cache:warmup --env prod
endif

assets:
ifeq ($(ENVIRONMENT_DEBUG), false)
	php bin/console assets:install
else
	php bin/console assets:install
endif

fix:
	php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix src --rules=@PSR1,@PSR2,@Symfony,@DoctrineAnnotation,@PHP70Migration,@PHP71Migration --verbose
	php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix config/migrations --rules=@PSR1,@PSR2,@Symfony,@DoctrineAnnotation,@PHP70Migration,@PHP71Migration --verbose
	php vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix tests --rules=@PSR1,@PSR2,@Symfony,-binary_operator_spaces,@PHP70Migration,@PHP71Migration --verbose

phpunit:
	php vendor/bin/phpunit

migrate-up:
	vendor/bin/phinx migrate

migrate-down:
	vendor/bin/phinx rollback

model:
	bin/console pomm:generate:relation-all -d src/Infrastructure -a 'Model' db $(table)

generate-models:
	php bin/console pomm:generate:schema-all db public -d ./src/Infrastructure/Model -a App\Infrastructure\Model --psr4