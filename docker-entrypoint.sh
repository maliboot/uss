#!/usr/bin/env bash

if [ "${APP_ENV}" == "test" ]; then
    composer install;
#    composer cs-fix;
    php bin/hyperf.php server:watch
else
    composer install --no-dev -o;
    php /opt/www/bin/hyperf.php start;
fi
