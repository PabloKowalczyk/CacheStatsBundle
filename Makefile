.PHONY: test

test:
	# With APCu enabled
	@docker compose exec -T -w /var/www/bundle --user=www-data apache php -d apc.enable_cli=1 vendor/bin/phpunit
	# With APCu disabled
	@docker compose exec -T -w /var/www/bundle --user=www-data apache php -d apc.enable_cli=0 vendor/bin/phpunit
