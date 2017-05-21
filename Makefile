-include locals.mk # <- secrets in here

# use prior install of composer & wp-cli, else install to curr-dir
CMPSR := $(if $(shell which composer), $(shell which composer), bin/composer)
WPCLI := $(if $(shell which wp), $(shell which wp), bin/wp)

.PHONY: composer wpcli clean update-salts test

wp wp-content vendor: wpcli composer
	composer install

tmp bin:
	-mkdir -p $@

composer: $(CMPSR)
bin/composer: | bin
	php -r "copy('https://getcomposer.org/installer', 'composer-installer.phar');" && \
		php composer-installer.phar --install-dir=bin --filename=composer
	-rm composer-installer.phar

wpcli: $(WPCLI)
bin/wp: | bin
	php -r "copy('https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar', '$@');" && \
		chmod +x $@

update-salts: | tmp
	curl -L https://api.wordpress.org/secret-key/1.1/salt > tmp/salts.tmp && \
	sed -i.bak -e "/^define('AUTH_KEY',/,/^define('NONCE_SALT',/d" -e "/^# BEGIN SALTS$$/r tmp/salts.tmp" wp-config.php && \
	rm tmp/salts.tmp

clean:
	-rm -rf vendor
	-rm -rf bin
	-rm -rf wp
	-rm -rf wp-content
	-rm -f composer.lock
